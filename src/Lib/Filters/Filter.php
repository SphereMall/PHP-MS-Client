<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 12:57 PM
 */

namespace SphereMall\MS\Lib\Filters;

use SphereMall\MS\Lib\Filters\ElasticSearch\MultiFullTextFilter;

/**
 * @property array $availableFilters
 * @property array $filters
 */
class Filter
{
    #region [Properties]
    private $availableFilters = [
        FilterOperators::LIKE,
        FilterOperators::LIKE_LEFT,
        FilterOperators::LIKE_RIGHT,
        FilterOperators::EQUAL,
        FilterOperators::NOT_EQUAL,
        FilterOperators::GREATER_THAN,
        FilterOperators::LESS_THAN,
        FilterOperators::GREATER_THAN_OR_EQUAL,
        FilterOperators::LESS_THAN_OR_EQUAL,
        FilterOperators::IS_NULL,
        FilterOperators::IN,
        FilterOperators::NOT_IN,
    ];

    protected $filters;
    #endregion

    #region [Constructor]
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
     *
     * @return $this
     */
    public function setFilters($filters = [])
    {
        foreach ($filters as $field => $rules) {
            if ($field === 'fullSearch') {
                $this->addFilter($field, $rules, null);
                continue;
            }

            if (is_a($rules, MultiFullTextFilter::class)) {
                $this->addFilter($field, $rules, null);
                continue;
            }

            foreach ($rules as $operator => $value) {
                if (!in_array($operator, $this->availableFilters) || (empty($value) && $value != '0')) {
                    continue;
                }
                $this->addFilter($field, $value, $operator);
            }
        }

        return $this;
    }

    /**
     *  Adds a filter to the resource request
     *
     * @param string $field the field to filter on
     * @param string|array $value the value of the attribute to operate on
     * @param string $operator the filter operator (eq,ne etc)
     *
     * @return $this
     */
    public function addFilter($field, $value, $operator)
    {
        if ((is_numeric($field) || !empty($field)) && (!empty($value) || $value == '0')) {
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
        foreach ($this->filters ?? [] as $field => $rules) {
            if (($compounded = $this->compound($field, $rules))) {
                $set = array_merge($set, $compounded);
            }

        }

        return sprintf("[%s]", implode(',', $set));
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
        } elseif (is_a($rules, MultiFullTextFilter::class)) {
            $out[] = (string)$rules;

            return $out;
        }
        $out[] = json_encode([$field => $rules]);

        return $out;
    }
}
