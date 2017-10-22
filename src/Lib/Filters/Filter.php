<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 12:57 PM
 */

namespace SphereMall\MS\Lib\Filters;

class Filter
{
    #region [Constructor]
    /**
     * @var array
     */
    private $availableFilters = [
        FilterOperators::LIKE,
        FilterOperators::LIKE_LEFT,
        FilterOperators::LIKE_RIGHT,
        FilterOperators::EQUAL,
        FilterOperators::NOT_EQUAL,
    ];

    /**
     * @var array
     */
    private $filters;

    public function __construct($filters = [])
    {
        if (!empty($filters)) {
            $this->setFilters($filters);
        }
        return $this;
    }
    #endregion

    /**
     *  Get the filter array
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return $this
     */
    public function setFilters($filters = [])
    {
        foreach ($filters as $field => $rules) {
            if ($field == 'fullSearch') {
                $this->addFilter($field, null, $rules);
                continue;
            }

            foreach ($rules as $operator => $value) {
                if (!in_array($operator, $this->availableFilters) || empty($value)) {
                    continue;
                }
                $this->addFilter($field, $operator, $value);
            }
        }
        return $this;
    }

    /**
     *  Adds a filter to the resource request
     *
     * @param string $operator the filter operator (eq,ne etc)
     * @param string $field the field to filter on
     * @param string $value the value of the attribute to operate on
     *
     * @return $this
     */
    public function addFilter($field, $operator, $value)
    {
        if (!empty($field) && !empty($value)) {
            if (!is_null($operator)) {
                $this->filters[$field][$operator] = $value;
            } else {
                $this->filters[$field] = $value;
            }
        }
        return $this;
    }

    /**
     *  Removes a filter operation by attribute name and operator
     *
     * @param string $operator the filter operator (eq,ne etc)
     * @param string $field the field to remove filter
     *
     * @return $this
     */
    public function removeFilter($field, $operator)
    {
        if (isset($this->filters[$field][$operator])) {
            unset($this->filters[$field][$operator]);
        }
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
        foreach ($this->filters as $field => $rules) {
            if (($compounded = $this->compound($field, $rules))) {
                $set = array_merge($set, $compounded);
            }

        }
        return implode(':', $set);
    }

    /**
     *  Removes a filter operation by attribute name and operator
     *
     * @param string $field the field
     * @param array $rules the rules for this operator
     *
     * @return array
     */
    private function compound($field, $rules)
    {
        $out = [];
        if (is_array($rules)) {
            foreach ($rules as $operator => $value) {
                $out[] = json_encode([$field => [$operator => $value]]);
            }
            return $out;
        }
        $out[] = json_encode([$field => $rules]);

        return $out;
    }
}