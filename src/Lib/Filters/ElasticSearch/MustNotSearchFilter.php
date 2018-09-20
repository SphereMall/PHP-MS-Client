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
 * @property FacetedInterface[] $facets
 * @property SearchInterface[] | AutoCompleteInterface[] $elements
 */
class MustNotSearchFilter extends SearchFilter
{
    protected $filterKey = "must_not";
}
