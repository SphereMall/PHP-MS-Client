<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 17:49
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements;


use SphereMall\MS\Lib\Filters\Interfaces\AttributeValuesInterface;

class AttributeValueIdElement implements AttributeValuesInterface
{
    private $values = [];

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return "id";
    }

    /**
     * @return array
     */
    public function getFieldValues()
    {
        return $this->values;
    }
}
