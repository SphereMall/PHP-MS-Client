<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Filter;
use SphereMall\MS\Lib\Filters\Interfaces\SearchFilterInterface;

/**
 * Class BaseFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 * @property SearchFilterInterface[] $queries
 */
abstract class BaseFilter extends Filter implements SearchFilterInterface
{
    protected $indexes;

    /**
     * @return $this
     */
    public function reset()
    {
        $this->indexes = null;

        return $this;
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
     * @return array
     */
    protected function addIndexToFilters(): array
    {
        return ['index' => implode(',', $this->indexes)];
    }
}
