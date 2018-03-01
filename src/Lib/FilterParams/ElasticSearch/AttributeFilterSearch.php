<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:09
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchFacetedInterface;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchQueryInterface;

/**
 * Class AttributeFilterSearch
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 *
 * @property int   $attributeId
 * @property array $attributeValueIds
 */
class AttributeFilterSearch extends FilterParams implements SearchQueryInterface, SearchFacetedInterface
{
    protected $attributeId;
    protected $attributeValueIds;

    /**
     * AttributeFilterParams constructor.
     * @param int $attributeId
     * @param array $attributeValueIds
     */
    public function __construct(int $attributeId, array $attributeValueIds)
    {
        $this->attributeId       = $attributeId;
        $this->attributeValueIds = $attributeValueIds;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getParams()
    {
        return ["{$this->attributeId}_attr.valueId" => $this->attributeValueIds];
    }

    /**
     * @return array
     */
    public function getFacetedParams()
    {
        return ['field' => "{$this->attributeId}_attr.valueId"];
    }
}
