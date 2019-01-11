<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 14.11.2018
 * Time: 12:51
 */
namespace SphereMall\MS\Lib\Filters\ElasticIndexer;

use SphereMall\MS\Lib\FilterParams\ElasticIndexer\EntityFilterParams;
use SphereMall\MS\Lib\Filters\Filter;

/**
 * Class EntitiesFilter
 * @package SphereMall\MS\Lib\Filters\ElasticIndexer
 * @property EntityFilterParams $entitiesFilters
 */
class EntitiesFilter extends Filter
{
    protected $filters = [];

    public function setFilters($entitiesFilters = [])
    {
        foreach ($entitiesFilters as $entityFilter) {
            if ($entityFilter instanceof EntityFilterParams) {
                $this->filters += $entityFilter->getParams();
            }
        }
    }
}
