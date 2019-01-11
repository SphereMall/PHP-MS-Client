<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 11:56
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\Interfaces\AttributesValuesParams;

/**
 * Class AttributeValuesIdFilterParams
 *
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 */
class AttributeValuesIdFilterParams implements AttributesValuesParams
{
    private $values = [];

    /**
     * AttributeValuesFilterParams constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        foreach ($values as $value) {
            $this->setIds($value);
        }
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
        return "valueId";
    }

    /**
     * @param int $id
     */
    private function setIds(int $id)
    {
        $this->values[] = $id;
    }
}
