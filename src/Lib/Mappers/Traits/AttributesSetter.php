<?php
/**
 * Created by PhpStorm.
 * User: rokytskyi
 * Date: 2019-07-29
 * Time: 11:05
 */

namespace SphereMall\MS\Lib\Mappers\Traits;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Lib\Mappers\ProductAttributeValuesMapper;

/**
 * Trait AttributesSetter
 * @package SphereMall\MS\Lib\Mappers
 * @property $entity Entity
 * @property $data
 */
trait AttributesSetter
{
    /**
     * @return $this
     */
    protected function setAttributes()
    {
        if (!isset($this->data['attributes']) && isset($this->data['productAttributeValues'])) { // old structure for product entity
            $this->entity->attributes = (new ProductAttributeValuesMapper)->createObject($this->data['productAttributeValues'] ?? []);

            return $this;
        }

        $attributes = [];

        foreach ($this->data['entityAttributeValues'] ?? [] as $av) {
            $attributeId = $av['attributes']['attributeId'] ?? $av['attributeId'];

            if (!isset($attributes[$attributeId])) {
                $attribute = $av['attributes'][0] ?? $av['relationships']['attributes'][0] ?? $this->data['attributes'][$attributeId];
                $attributes[$attributeId] = new Attribute($attribute);
            }

            $attributeValue = isset($av['attributeValues'][0]) && is_array($av['attributeValues'][0]) ? $av['attributeValues'][0] : $av;
            $attributes[$attributeId]->values[$av['id']] = new AttributeValue($attributeValue);
        }

        $this->entity->attributes = $attributes;


        return $this;
    }
}