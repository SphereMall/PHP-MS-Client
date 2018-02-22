<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:09
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;

/**
 * Class AttributeFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 *
 * @property int   $attributeId
 * @property array $attributeValueIds
 */
class AttributeFilterParams extends FilterParams
{
    protected $attributeId;
    protected $attributeValueIds;

    /**
     * AttributeFilterParams constructor.
     * @param int $attributeId
     * @param int $attributeValueIds
     */
    public function __construct(int $attributeId, array $attributeValueIds)
    {
        $this->attributeId       = $attributeId;
        $this->attributeValueIds = $attributeValueIds;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return ["{$this->attributeId}_attr.valueId" => $this->attributeValueIds];
    }
}
