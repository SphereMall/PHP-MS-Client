<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 13:40
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigInterface;

class AttributesConfig implements ElasticConfigInterface
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

    private function setAttributeItem(int $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }
}
