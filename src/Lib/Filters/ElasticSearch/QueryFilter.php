<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\SearchFilterInterface;
/**
 * Class QueryFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 * @property SearchFilterInterface[] $queries
 */
class QueryFilter extends ComplexFilter
{
    protected $queries;

    /**
     * @param SearchFilterInterface $query
     * @return $this
     */
    public function addQuery(SearchFilterInterface $query)
    {
        $this->queries[] = $query;
        return $this;
    }

    /**
     * @param SearchFilterInterface[] $queries
     * @return $this
     */
    public function queries($queries)
    {
        foreach ($queries as $query) {
            $this->queries[] = $query;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        parent::reset();

        $this->indexes = null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQueries()
    {
        return $this->queries;
    }

    public function __toString()
    {
        return '';
    }

    /**
     * @param array $body
     * @return array
     */
    public function getSearchFilters($body = []): array
    {
        $set = $this->addIndexToFilters();

        $set = $this->setFilterFields($set);

        if (empty($this->queries)) {
            return $set;
        }
        foreach ($this->queries as $query) {
            $set = $query->getSearchFilters($set);
        }

        return $set;
    }
}
