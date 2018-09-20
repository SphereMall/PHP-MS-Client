<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 04.09.18
 * Time: 10:41
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\AutoCompleteInterface;

/**
 * Class ShouldSearchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 */
class ShouldSearchFilter extends SearchFilter
{
    protected $filterKey = "should";
}
