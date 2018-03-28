<?php
/**
 * Project PHP-MS-Client.
 * File: FacetedHelper.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 13:48
 */

namespace SphereMall\MS\Lib\Helpers;

/**
 * Class FacetedHelper
 * @package SphereMall\MS\Lib\Helpers
 */
class FacetedHelper
{

    /**
     * @param array $filters
     * @param array $filterArray
     * @param string $key
     * @param string $name
     *
     * @return array
     */
    public static function addFilter(array $filters, array $filterArray, string $key, string $name): array
    {
        if (isset($filterArray[$name][$key])) {
            unset($filterArray[$name][$key]);
        }
        if (sizeof($filterArray[$name]) > 0) {
            $filters['filter']['bool']['must'][] = $filterArray;
        }

        return $filters;
    }

    /**
     * @param array $param
     * @param array $filters
     *
     * @return array
     */
    public static function addAggregation(array $param, array $filters): array
    {
        if ($filters) {
            $aggregations = $filters;
            $aggregations['aggs'] = $param;

            return $aggregations;
        }

        return $param;
    }
}
