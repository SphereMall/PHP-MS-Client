<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Filters\Interfaces\AutoCompleteInterface;
use SphereMall\MS\Lib\Filters\Interfaces\FacetedInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchFilterInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;
use SphereMall\MS\Lib\Helpers\FacetedHelper;

/**
 * Class SearchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 * @property SearchFilterInterface[] $queries
 */
class QueryFilter extends Filter implements SearchFilterInterface
{
    protected $indexes;
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
        $this->queries = null;
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
     * @param array $indexes
     * @return $this
     */
    public function index(array $indexes)
    {
        /** @var ElasticSearchFilterElement $index */
        foreach ($indexes as $index) {
            $this->indexes = $index->getValues();
        }

        return $this;
    }

    /**
     * @param array $body
     * @return array
     */
    public function getSearchFilters($body = []): array
    {
        $set = $this->addIndexToFilters();
        if (empty($this->queries)) {
            return $set;
        }
        foreach ($this->queries as $query) {
            $set = $query->getSearchFilters($set);
        }

        return $set;
    }

    /**
     * @return array
     */
    protected function addIndexToFilters(): array
    {
        return ['index' => implode(',', $this->indexes)];
    }
}
