<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 19.11.18
 * Time: 17:10
 */

namespace SphereMall\MS\Resources\ElasticSearch;

use SphereMall\MS\Lib\Filters\Elastic\Builders\EntitiesFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\GroupByFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\KeywordFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\QueryFactory;
use SphereMall\MS\Lib\Filters\Elastic\Builders\ParamsFilterBuilder;
use SphereMall\MS\Lib\Filters\Elastic\Config\ConfigBuilder;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;
use SphereMall\MS\Lib\Http\ElasticSearchRequest;
use SphereMall\MS\Lib\Makers\ElasticSearchGroupByMaker;
use SphereMall\MS\Lib\Makers\ElasticSearchMaker;
use SphereMall\MS\Lib\Makers\FacetsMaker;
use SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms\BasicAlgorithm;
use SphereMall\MS\Resources\Resource;

/**
 * Class ElasticResource
 *
 * @package SphereMall\MS\Resources\ElasticSearch
 */
class ElasticResource extends Resource
{
    private $config       = [];
    private $params       = [];
    private $factorValues = [];

    /**
     * @return string
     */
    public function getURI()
    {
        return 'elasticsearch';
    }

    /**
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function facets()
    {
        $params = $this->getFacetQueryParams();

        $response = $this->handler->handle('GET', $this->config, 'filter', $params);

        return $this->make($response, false, new FacetsMaker());
    }

    /**
     * @param BasicAlgorithm $algorithm
     *
     * @return $this
     */
    public function setFactors(BasicAlgorithm $algorithm)
    {
        $this->factorValues = $algorithm->getAlgorithm();

        return $this;
    }

    /**
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function all()
    {
        $params   = $this->getAllQueryParams();
        $response = (new ElasticSearchRequest($this->client, $this))->handle("GET", false, false, $params);

        return $this->make($response);
    }

    /**
     * @return array|int|null|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function first()
    {
        $this->limit(1, 0);
        $params   = $this->getAllQueryParams();
        $response = (new ElasticSearchRequest($this->client, $this))->handle("GET", false, false, $params);

        return $this->make($response, false);
    }

    /**
     * @param ConfigBuilder $config
     *`
     *
     * @return $this
     */
    public function setConfigs(ConfigBuilder $config)
    {
        $this->config = $config->getConfig();

        return $this;
    }

    /**
     * @param array $params
     *
     * @return $this
     */
    public function setFilter(array $params)
    {
        foreach ($params as $param) {
            if (!is_a($param, ElasticFilterInterface::class)) {
                continue;
            }

            $this->params[] = $param;
        }

        return $this;
    }

    /**
     * @param array $additionalParams
     *
     * @return array
     */
    protected function getFacetQueryParams(array $additionalParams = [])
    {
        $query = [];
        foreach ($this->params as $param) {
            /**@var $param ElasticFilterInterface* */
            $query += $param->getParams();
        }

        return array_merge($query, $additionalParams);
    }

    /**
     * @return array
     */
    protected function getAllQueryParams()
    {
        $this->maker = new ElasticSearchMaker();

        $result = [];

        foreach ($this->params as $param) {
            $result = $this->buildParams($param, $result);
        }

        return $result;
    }

    /**
     * @param $field
     *
     * @return array
     */
    protected function groupByAggs($field)
    {
        $result = [
            'variant' => [
                'terms' => [
                    'field' => $field,
                    'size'  => ($this->limit + $this->offset),
                ],
                'aggs'  => [
                    'value' => [
                        'top_hits' => [
                            'size'    => 1,
                            '_source' => 'scope',
                            'from'    => 0,
                        ],
                    ],
                    'sort'  => [
                        'bucket_sort' => [
                            'from' => $this->offset,
                            'size' => $this->limit,
                        ],
                    ],
                ],
            ],
        ];

        if ($this->factorValues) {
            $result['variant']['terms']['order'] = [
                'factorSort' => 'desc',
            ];

            $result['variant']['aggs']['factorSort']['max']['script'] = $this->factorValues;
        }

        return $result;
    }

    /**
     * @param $param
     * @param $result
     *
     * @return array
     */
    protected function buildParams($param, $result): array
    {
        $className = get_class($param);

        switch ($className) {
            case EntitiesFilterBuilder::class;
                $result['index'] = $param->getValues();
                break;

            case ParamsFilterBuilder::class;

                foreach ($param->getValues() as $value) {
                    $should[] = $this->buildQuery($value);
                }

                $result['body']['query']['bool']['must'][]['bool']['should'] = $should;
                break;

            case GroupByFilterBuilder::class;
                $this->maker = new ElasticSearchGroupByMaker();

                $result['body']['aggs'] = $this->groupByAggs($param->getValues());
                break;

            case KeywordFilterBuilder::class;
                $result['body']['query']['bool']['must'][] = $this->keywordBuilder($param->getValues());
                break;

        }

        return $result;
    }

    protected function keywordBuilder($data)
    {
        return [
            'multi_match' => [
                'query'  => $data['value'],
                'fields' => $data['fields'],
            ],
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    protected function buildQuery(array $params): array
    {
        $queryElements = [];

        foreach ($params as $type => $values) {
            /**@var $obj \SphereMall\MS\Lib\Filters\Interfaces\ElasticQueryInterface * */
            $queryElements = QueryFactory::createInstance($type, $values)->buildQuery($queryElements);
        }

        return [
            'bool' => [
                'must' => $queryElements,
            ],
        ];
    }
}
