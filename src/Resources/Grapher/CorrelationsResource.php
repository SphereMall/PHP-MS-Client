<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Grapher;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Helpers\CorrelationTypeHelper;
use SphereMall\MS\Lib\Elastic\Builders\BodyBuilder;
use SphereMall\MS\Lib\Elastic\Builders\QueryBuilder;
use SphereMall\MS\Lib\Elastic\Queries\MustQuery;
use SphereMall\MS\Lib\Elastic\Queries\ShouldQuery;
use SphereMall\MS\Lib\Elastic\Queries\TermQuery;
use SphereMall\MS\Lib\Elastic\Queries\TermsQuery;
use SphereMall\MS\Lib\Elastic\Sort\SortBuilder;
use SphereMall\MS\Lib\Elastic\Sort\SortElement;
use SphereMall\MS\Lib\Helpers\ElasticSearchIndexHelper;
use SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms\DynamicFactors;

/**
 * Class GridResource
 *
 * @package SphereMall\MS\Resources\Users
 */
class CorrelationsResource extends GrapherResource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "correlations";
    }

    /**
     * @param int $id
     *
     * @throws Exception
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with correlations");
    }

    /**
     * @param $id
     * @param $data
     *
     * @throws Exception
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with correlations");
    }

    /**
     * @param $data
     *
     * @throws Exception
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with correlations");
    }

    /**
     * @param $id
     *
     * @return bool|void
     * @throws Exception
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with correlations");
    }
    #endregion

    /**
     * @param int    $id
     * @param string $forClassName
     *
     * @return array|Collection
     * @throws GuzzleException
     */
    public function getById(int $id, string $forClassName)
    {
        $params    = $this->getQueryParams();
        $type      = CorrelationTypeHelper::getGraphTypeByClass($forClassName);
        $uriAppend = "{$type}/{$id}";

        unset($params['limit'], $params['offset']);

        $response = $this->handler->handle('GET', false, $uriAppend, $params)->getData();
        if (!$response) {
            return [];
        }

        $functionalNames = [];
        if ($filter = $this->getFilter()) {
            $functionalNames = current($filter->getElements())['functionalNames'] ?? null;
        }

        $request = $this->client->elastic()
                                ->search($this->prepareElasticSearchBody($response, ['functionalNameId' => $functionalNames]));

        return $this->meta ? $request->withMeta()->all() : $request->all();

    }

    /**
     * @param string $entityFrom
     * @param array  $entityIds
     *
     * @param array  $filterParams
     *
     * @return array|int|Entity|Collection
     * @throws GuzzleException
     */
    public function getFromEntityByIds(string $entityFrom, array $entityIds, array $filterParams = [])
    {
        $uriAppend = "from/{$entityFrom}";
        $params    = ['entityIds' => implode(",", $entityIds)];
        if ($filterParams) {
            $params['params'] = json_encode([$filterParams]);
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params)->getData();
        if (!$response) {
            return [];
        }

        $functionalNames = [];
        if (isset($filterParams['functionalNames']) && $filterParams['functionalNames']) {
            $functionalNames = $filterParams['functionalNames'];
        }

        return $this->client->elastic()
                            ->search($this->prepareElasticSearchBody($response, ['functionalNameId' => $functionalNames]))
                            ->all();
    }

    /**
     * @param string $entity1
     * @param string $entity2
     * @param array  $objectIds - ids of entity1
     *
     * @return array|int|Entity|Collection
     * @throws GuzzleException
     */
    public function getBidirectional(string $entity1, string $entity2, array $objectIds)
    {
        $uriAppend = "bidirectional/{$entity1}/{$entity2}";
        $params    = ['objectIds' => implode(',', $objectIds)];

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }

    #region [Private methods]

    /**
     * @param array $data
     * @param array $params
     *
     * @return BodyBuilder
     */
    private function prepareElasticSearchBody(array $data, array $params = []): BodyBuilder
    {
        $entityWeights = [];
        $indexes       = [];
        foreach (array_column($data, 'attributes') as $correlation) {
            $entityCodeInSingular = $correlation['type'];
            if (substr($entityCodeInSingular, -1, 1) == 's') {
                $entityCodeInSingular = substr($correlation['type'], 0, -1);
            }

            $className = "SphereMall\\MS\\Entities\\" . ucfirst($entityCodeInSingular);
            if (class_exists($className)) {
                $indexes[$entityCodeInSingular] = $className;
            }

            $entityWeights[$correlation['type']][$correlation[$entityCodeInSingular . 'Id']] = doubleval($correlation['value']);
        }

        $mustQueries = [];
        foreach ($entityWeights as $entity => $weights) {
            $mustQueries[] = new MustQuery([
                new TermQuery('_type', $entity),
                new TermsQuery('_id', array_keys($weights)),
            ]);
        }
        $mustQuery = [
            new TermQuery('visible', 1),
            new ShouldQuery($mustQueries),
        ];
        if (isset($params['functionalNameId']) && $params['functionalNameId']) {
            $mustQuery[] = new TermsQuery('functionalNameId', $params['functionalNameId']);
        }
        $mustQuery = new MustQuery($mustQuery);

        $body   = new BodyBuilder();
        $query  = (new QueryBuilder())->setMust($mustQuery);
        $script = (new DynamicFactors($entityWeights))->getAlgorithm();
        $sort[] = new SortElement('_script', 'desc', [
            'type'   => 'number',
            'script' => $script,
        ]);

        return $body->query($query)
                    ->limit($this->limit)
                    ->offset($this->offset)
                    ->sort(new SortBuilder($sort))
                    ->indexes(ElasticSearchIndexHelper::getIndexesByClasses($indexes));
    }
    #endregion
}
