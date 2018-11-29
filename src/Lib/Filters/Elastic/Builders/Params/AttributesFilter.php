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

/**
 * Class AttributesFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params
 */
class AttributesFilter implements ParamFilterElementInterface
{
    private $attributes = [];

    /**
     * AttributesFilter constructor.
     *
     * @param AttributesElement ...$elements
     */
    public function __construct(AttributesElement ...$elements)
    {
        foreach ($elements as $element) {
            $this->attributes += $element->getAttributes();
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'attributes' => $this->attributes,
        ];
    }
}
