<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 12:57 PM
 */

namespace SphereMall\MS\Lib\Filters;

/**
 * @property array $availableFilters
 * @property array $filters
 */
class GridFilter extends Filter
{
    /**
     * @param array $filters
     * @return $this
     */
    public function setFilters($filters = [])
    {
        foreach ($filters as $key => $value) {
            $this->addFilter($key, $value);
        }
        return $this;
    }

    /**
     *  Adds a filter to the resource request
     * @param string $field the field to filter on
     * @param string $value the value of the attribute to operate on
     *
     * @param $operator
     * @return $this
     */
    public function addFilter($field, $value, $operator = null)
    {
        $this->filters[$field] = $value;
        return $this;
    }

    /**
     *  Convert the filter object to a string for a URL
     *
     * @return string
     */
    public function __toString()
    {
        $set = [];
        foreach ($this->filters as $key => $value) {
            $set[$key] = $value;
        }

        return http_build_query($set);
    }

}