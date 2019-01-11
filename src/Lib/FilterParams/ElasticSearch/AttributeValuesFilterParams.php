<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 11:54
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\Interfaces\AttributesValuesParams;

/**
 * Class AttributeValuesFilterParams
 *
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 */
class AttributeValuesFilterParams implements AttributesValuesParams
{
    private $values = [];

    /**
     * AttributeValuesFilterParams constructor.
     *
     * @param array $values
     */
    public function __construct(array $values) {
        $this->values = $values;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getParamName()
    {
        return "attributeValue";
    }
}
