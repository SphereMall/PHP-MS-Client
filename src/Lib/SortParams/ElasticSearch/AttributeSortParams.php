<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:37
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch;

use SphereMall\MS\Lib\SortParams\SortParams;

class AttributeSortParams extends SortParams
{
    protected $attributeId;
    protected $attributeValueId;

    /**
     * AttributeSortParams constructor.
     * @param int $attributeId
     * @param int $attributeValueId
     */
    public function __construct(int $attributeId, int $attributeValueId)
    {
        $this->attributeId = $attributeId;
        $this->attributeValueId = $attributeValueId;
    }

    public function getParams()
    {
        return '*_attr.orderNumber';
    }
}
