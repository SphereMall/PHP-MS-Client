<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:02
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements;


class AttributesElement
{
    private $attribute       = 0;
    private $attributeValues = [];

    public function __construct(int $attribute, array $attributeValues)
    {
        $this->attribute       = $attribute;
        $this->attributeValues = $attributeValues;
    }

    public function getAttributes()
    {
        return [
            (string)$this->attribute => $this->attributeValues,
        ];
    }
}
