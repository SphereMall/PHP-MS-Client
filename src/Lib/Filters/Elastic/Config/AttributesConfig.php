<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 13:40
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigElementInterface;

class AttributesConfig implements ElasticConfigElementInterface
{
    private $attributes = [];

    public function __construct(array $attributes)
    {
        foreach ($attributes as $attribute) {
            $this->setAttributeItem($attribute);
        }
    }

    /**
     * @return mixed
     */
    public function getElements(): array
    {
        return [
            'attributes' => $this->attributes,
        ];
    }

    private function setAttributeItem(string $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }
}
