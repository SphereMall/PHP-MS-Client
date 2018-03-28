<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:37
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch;

use SphereMall\MS\Lib\SortParams\SortParams;

/**
 * Class AttributeSortParams
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch
 * @property int $attributeId
 */
class AttributeSortParams extends SortParams
{
    protected $attributeId;

    /**
     * AttributeSortParams constructor.
     * @param int    $attributeId
     * @param string $order
     */
    public function __construct(int $attributeId, string $order = 'asc')
    {
        $this->attributeId = $attributeId;
        $this->order       = $order;
    }

    public function getParams()
    {
        return [$this->attributeId . '_attr.valueOrderNumber' => ['order' => $this->order]];
    }
}
