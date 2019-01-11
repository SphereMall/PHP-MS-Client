<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:09
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\AttributesValuesParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchFacetedInterface;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchQueryInterface;

/**
 * Class AttributeFilterParams
 *
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 *
 * @property int                    $attributeId
 * @property AttributesValuesParams $attributeValues
 */
class AttributeFilterParams extends FilterParams implements SearchQueryInterface, SearchFacetedInterface
{
    protected $attributeId;
    protected $attributeValues;

    /**
     * AttributeFilterParams constructor.
     *
     * @param string                 $attributeId
     * @param AttributesValuesParams $attributeValues
     */
    public function __construct(string $attributeId, AttributesValuesParams $attributeValues)
    {
        $this->attributeId     = $attributeId;
        $this->attributeValues = $attributeValues;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getParams()
    {
        return ["{$this->attributeId}_attr." . $this->attributeValues->getParamName() => $this->attributeValues->getValues()];
    }

    /**
     * @return array
     */
    public function getFacetedParams()
    {
        return ['field' => "{$this->attributeId}_attr.valueId"];
    }
}
