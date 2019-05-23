<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 27.02.19
 * Time: 10:40
 */

namespace SphereMall\MS\Lib\Elastic\Builders;


use SphereMall\MS\Lib\Elastic\Sort\SortBuilder;

/**
 * Class BodyBuilder
 *
 * @package SphereMall\MS\Lib\Elastic\Builders
 *
 * @method getQuery()
 * @method getAggregations()
 * @method getSort()
 * @method getSource()
 * @method getIndexes()
 * @method getLimit()
 * @method getOffset()
 * @method getFilter()
 * @method getChannels()
 */
class BodyBuilder
{
    private $query        = [];
    private $aggregations = [];
    private $sort         = [];
    private $source       = [];
    private $indexes      = [];
    private $limit        = 0;
    private $offset       = 0;
    private $filter       = [];
    private $channels     = [];

    /**
     * @param $name
     * @param $arguments
     *
     * @return array
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (stripos($name, 'get') === false) {
            throw new \Exception("Method '{$name}' not exist");
        }

        $propName = strtolower(str_replace("get", "", $name));

        if (!isset($this->{$propName})) {
            throw new \Exception("Property with name '{$propName}' not exist");
        }

        return $this->{$propName};
    }

    /**
     * @param QueryBuilder $query
     *
     * @return $this
     */
    public function query(QueryBuilder $query): BodyBuilder
    {
        $this->query = $query->toArray();

        return $this;
    }

    /**
     * @param AggregationBuilder $aggregation
     *
     * @return $this
     */
    public function aggregations(AggregationBuilder $aggregation): BodyBuilder
    {
        $this->aggregations[] = $aggregation->toArray();

        return $this;
    }

    /**
     * @param SortBuilder $sort
     *
     * @return $this
     */
    public function sort(SortBuilder $sort): BodyBuilder
    {
        $this->sort = $sort->toArray();

        return $this;
    }

    /**
     * @param array $source
     *
     * @return $this
     */
    public function source(array $source): BodyBuilder
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @param array $indexes
     *
     * @return $this
     */
    public function indexes(array $indexes): BodyBuilder
    {
        $this->indexes = implode(',', $indexes);

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function limit(int $limit): BodyBuilder
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param int $offset
     *
     * @return $this
     */
    public function offset(int $offset): BodyBuilder
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @param FilterBuilder $filter
     *
     * @return $this
     */
    public function filter(FilterBuilder $filter): BodyBuilder
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param array $channelIds
     *
     * @return $this
     */
    public function channels(array $channelIds): BodyBuilder
    {
        $this->channels = $channelIds;

        return $this;
    }

}
