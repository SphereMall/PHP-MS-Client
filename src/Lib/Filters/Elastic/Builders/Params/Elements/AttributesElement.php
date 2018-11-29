<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:02
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements;

use SphereMall\MS\Lib\Filters\Interfaces\AttributeValuesInterface;

/**
 * Class AttributesElement
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements
 */
class AttributesElement
{
    private $attribute       = 0;
    private $attributeValues = [];

    /**
     * AttributesElement constructor.
     *
     * @param string                   $attribute
     * @param AttributeValuesInterface $attributeValues
     */
    public function __construct(string $attribute, AttributeValuesInterface $attributeValues)
    {
        $this->attribute       = $attribute;
        $this->attributeValues = $attributeValues;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return [
            $this->attribute => [
                $this->attributeValues->getFieldName() => $this->attributeValues->getFieldValues(),
            ],
        ];
    }
}
