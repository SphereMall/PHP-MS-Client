<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 13:44
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Filter;

/**
 * Class SearchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 */
class SearchFilter extends Filter
{
    protected $indexes;
    protected $elements;

    /**
     * @param array $elements
     * @return $this
     */
    public function elements(array $elements)
    {
        /** @var ElasticSearchFilterElement $element */
        foreach ($elements as $element) {
            $this->elements[] = $element->getValues();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->elements = null;
        $this->indexes  = null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->elements;
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
     * @return string
     */
    public function __toString()
    {
        $set = ['index' => implode(',', $this->indexes),];
        if (!empty($this->elements)) {
            $set['body']['query']['bool']['filter'] = $this->elements;
        }

        return json_encode($set);
    }
}
