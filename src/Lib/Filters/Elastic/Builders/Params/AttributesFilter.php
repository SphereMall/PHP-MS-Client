<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:03
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\AttributesElement;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

class AttributesFilter implements ParamFilterElementInterface
{
    private $attributes = [];

    public function __construct(AttributesElement ...$elements)
    {
        foreach ($elements as $element) {
            $this->attributes += $element->getAttributes();
        }
    }

    public function getParams(): array
    {
        return [
            'attributes' => $this->attributes,
        ];
    }
}
