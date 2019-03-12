<?php
/**
 * Created by PhpStorm.
 * User: ddis
 * Date: 05.03.19
 * Time: 23:37
 */

namespace SphereMall\MS\Lib\Elastic\Builders;


use SphereMall\MS\Lib\Elastic\Interfaces\SearchInterface;
use SphereMall\MS\Lib\Elastic\Queries\MultiMatchQuery;
use SphereMall\MS\Lib\Elastic\Queries\MustQuery;

/**
 * Class MSearch
 *
 * @package SphereMall\MS\Lib\Elastic\Builders
 */
class MSearch implements SearchInterface
{
    private $builders = [];

    /**
     * MSearch constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        foreach ($items as $item) {
            $this->setItem($item);
        }
    }

    /**
     * @param BodyBuilder $builder
     *
     * @return $this
     */
    private function setItem(BodyBuilder $builder)
    {
        $this->builders[] = $builder;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $result = [];
        foreach ($this->builders as $builder) {
            if ($filter = $builder->getFilter()) {
                $params = $this->getParamsFromFilter($filter);
            }

            /**@var \SphereMall\MS\Lib\Elastic\Builders\BodyBuilder $builder * */
            $result[] = [
                "index" => $params['index'] ?? $builder->getIndexes(),
            ];

            if ($q = $builder->getQuery()) {
                $res['query'] = array_merge_recursive($q, $params['query'] ?? []);
            }

            if ($size = $builder->getLimit()) {
                $res['size'] = $size;
            }

            if ($from = $builder->getOffset()) {
                $res['from'] = $from;
            }

            if ($source = $builder->getSource()) {
                $res['_source'] = $source;
            }

            if ($aggregations = $builder->getAggregations()) {
                $res['aggs'] = $aggregations;
            }

            if ($sort = $builder->getSort()) {
                $res['sort'] = $sort;
            }

            if (isset($res)) {
                $result[] = $res;
            }
        }

        return [
            'body' => $result,
        ];
    }

    /**
     * @param $filter
     *
     * @return array
     */
    private function getParamsFromFilter(FilterBuilder $filter)
    {
        $result = [];
        $query  = [];
        $params = $filter->getParams();

        if ($params['entities']) {
            $result['index'] = $params['entities'];
        }

        if (isset($params['keyword'])) {
            $query[] = new MultiMatchQuery($params['keyword']['value'], $params['keyword']['fields']);
        }

        foreach ($params['params'] ?? [] as $param) {
            /**@var \SphereMall\MS\Lib\Elastic\Interfaces\ElasticParamBuilderInterface $param**/
            $query[] = $param->createFilter();
        }

        if ($query) {
            $result['query'] = (new QueryBuilder())->setMust(new MustQuery($query))->toArray();
        }

        return $result;
    }
}
