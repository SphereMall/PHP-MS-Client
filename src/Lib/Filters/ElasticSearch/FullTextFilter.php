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
 * @property array  $fields
 * @property string $keyword
 */
class FullTextFilter extends Filter
{
    protected $fields = [
        "title_*",
        "shortDescription_*",
        "fullDescription_*",
    ];

    protected $keyword;
    protected $index;
    protected $orderFields;

    /**
     * @param string $index
     * @return $this
     */
    public function index(string $index)
    {
        $this->index = $index;

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
     * @return $this
     */
    public function order(array $fields)
    {
        $defaultOrder = ['order' => 'asc'];
        foreach ($fields as $field => $value) {
            if (!is_array($value)) {
                $this->orderFields[$value] = $defaultOrder;
                continue;
            }
            $this->orderFields[$field] = ['order' => isset($value['order']) ? $value['order'] : ['order' => 'asc']];
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
        $set = [
            'index' => $this->index,
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

        if (!empty($this->orderFields)) {
            $set['body']['sort'] = $this->orderFields;
        }

        return json_encode($set);
    }
}
