<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\AutoCompleteInterface;
use SphereMall\MS\Lib\Filters\Interfaces\FacetedInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;
use SphereMall\MS\Lib\Helpers\FacetedHelper;

/**
 * Class SearchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 * @property FacetedInterface[] $facets
 * @property array $fields
 * @property SearchInterface[] | AutoCompleteInterface[] $elements
 */
class SearchFilter extends ComplexFilter
{
    protected $elements;
    protected $facets;

    protected $filterKey = "filter";

    /**
     * @param array $elements
     * @return $this
     */
    public function elements(array $elements)
    {
        foreach ($elements as $element) {
            if (is_a($element, SearchInterface::class)) {
                $this->elements[] = $element;
            }
            if (is_a($element, FacetedInterface::class)) {
                $this->facets[] = $element;
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        parent::reset();

        $this->elements = null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->elements;
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
        $body = $this->addIndexToFilters($body);

        $body = $this->setFilterFields($body);

        if (!isset($body['body']['query']['bool'])) {
            $body['body']['query']['bool'] = [];
        }

        if (empty($this->elements)) {
            return $body;
        }

        foreach ($this->elements as $element) {

            $body['body']['query']['bool'][$this->filterKey][] = $element->getValues();
            if (is_a($element, AutoCompleteInterface::class)) {
                $body['body'] = $element->getHighlight();
            }
        }

        return $body;
    }

    /**
     * @return array
     */
    public function getFacetedFilters(): array
    {
        $set = $this->addIndexToFilters();
        $set['size'] = 0;
        if (empty($this->facets)) {
            return $set;
        }
        foreach ($this->facets as $faceted) {
            $param = $faceted->getFacetedValues();
            $key = array_keys($param)[0];
            $filters = [];
            /** @var SearchInterface $filter */
            foreach ($this->facets as $filter) {
                $filters = FacetedHelper::addFilter($filters, $filter->getValues(), $key, $filter->getName());
            }
            $set['body']['aggs'][$key] = FacetedHelper::addAggregation($param, $filters)[$key];
        }

        return $set;
    }
}
