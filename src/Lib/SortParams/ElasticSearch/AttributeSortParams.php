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
     * @param int $attributeId
     */
    public function __construct(int $attributeId)
    {
        $this->attributeId = $attributeId;
    }

    public function getParams()
    {
        return $this->attributeId . '_attr.valueOrderNumber';
    }
}
