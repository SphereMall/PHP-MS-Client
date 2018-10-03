<?php
/**
 * Created by PhpStorm.
 * User: Dividych
 * Date: 3.10.2018
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
 * Class BodyFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property array $indexes
 * @property array $body
 */
class BodyFilter extends Filter
{
    protected $indexes;
    protected $body;

    /**
     * @param array $body
     *
     * @return $this
     */
    public function body(array $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->body = null;
        $this->indexes = null;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        $body = $this->addIndexToFilters();
        if (!isset($body['body'])) {
            $body['body'] = [];
        }

        $body['body'] = $this->body;

        return json_encode($body);
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
