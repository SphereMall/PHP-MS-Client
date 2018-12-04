<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:03
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;

use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributesElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributeValueIdElement;
use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributeValuesElement;
use SphereMall\MS\Lib\Filters\Interfaces\ElasticQueryInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

/**
 * Class AttributesFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params
 */
class AttributesFilter extends BasicQueryBuilder implements ParamFilterElementInterface
{
    private $attributes = [];
    private $elements   = [];

    /**
     * AttributesFilter constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements)
    {
        foreach ($elements as $type => $element) {
            if (is_a($element, AttributesElement::class)) {
                $this->setAttributes($element);
            } else {
                $this->setElement($type, $element);
            }
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        $result = [];
        /**@var $attribute AttributesElement* */
        foreach ($this->attributes as $attribute) {
            $result += $attribute->getAttributes();
        }

        return [
            'attributes' => $result,
        ];
    }

    /**
     * @param AttributesElement $element
     *
     * @return $this
     */
    private function setAttributes(AttributesElement $element)
    {
        $this->attributes[] = $element;

        return $this;
    }

    private function setElement($code, $element)
    {
        $this->elements[$code] = $element;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->elements;
    }

    public function buildQuery(array $elements): array
    {
        foreach ($this->getData() as $code => $values) {

            $key = array_keys($values)[0];

            switch ($key) {
                case "id":
                    $fieldName = AttributeValueIdElement::FIELD_NAME;
                    break;
                case "value" :
                    $fieldName = AttributeValuesElement::FIELD_NAME;
                    break;
            }

            $elements[] = [
                'terms' => [
                    "{$code}_attr.{$fieldName}" => $values[$key]
                ],
            ];
        }

        return $elements;
    }
}
