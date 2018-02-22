<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 15:43
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

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
    protected $fields = [
        "title_*",
        "shortDescription_*",
        "fullDescription_*",
    ];

    protected $keyword;
    protected $indexes;

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
