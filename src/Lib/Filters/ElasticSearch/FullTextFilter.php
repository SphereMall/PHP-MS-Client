<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 15:43
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\FieldsParams\ElasticSearch\FullTextSearchFieldsParams;
use SphereMall\MS\Lib\Filters\Filter;

/**
 * Class FullTextFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 *
 * @property string $keyword
 * @property array  $indexes
 */
class FullTextFilter extends Filter
{
    protected $fields;
    protected $keyword;
    protected $indexes;

    /**
     * FullTextFilter constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $fieldParams  = new FullTextSearchFieldsParams(['title', 'shortDescription', 'fullDescription']);
        $this->fields = $fieldParams->getFields();
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
     * @param string $keyword
     * @return FullTextFilter
     */
    public function keyword(string $keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     *  Convert the filter object to a string for a URL
     *
     * @return string
     */
    public function __toString()
    {
        $set = [
            'index' => implode(',', $this->indexes),
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'fields' => $this->fields,
                    ],
                ],
            ],
        ];

        if (!empty($this->keyword)) {
            $set['body']['query']['multi_match']['query'] = $this->keyword;
        }

        return json_encode($set);
    }
}
