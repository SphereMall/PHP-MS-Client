<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:35
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch;

use SphereMall\MS\Lib\SortParams\SortParams;

/**
 * Class FieldSortParams
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch
 * @property string $field
 */
class FieldSortParams extends SortParams
{
    protected $field;

    /**
     * FieldSortParams constructor.
     * @param string $field
     * @param string $order
     */
    public function __construct(string $field, string $order = 'asc')
    {
        $this->field = $field;
        $this->order = $order;
    }

    public function getParams()
    {
        return [$this->field => ['order' => $this->order]];
    }
}
