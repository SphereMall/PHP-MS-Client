<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/22/2017
 * Time: 12:09 PM
 */

namespace SphereMall\MS\Lib\Traits;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;

/**
 * Class InteractsWithAttributes
 * @package SphereMall\MS\Lib\Traits
 * @property Attribute[] $attributes
 */
trait InteractsWithAttributes
{
    /**
     * @param string $code
     * @return null|Attribute
     */
    public function getAttributeByCode(string $code)
    {
        if (empty($this->attributes)) {
            return null;
        }

        foreach ($this->attributes as $attribute) {
            if ($attribute->code == $code) {
                return $attribute;
            }
        }

        return null;
    }

    /**
     * @param string $code
     * @return null|AttributeValue
     */
    public function getFirstValueByAttributeCode(string $code)
    {
        $attribute = $this->getAttributeByCode($code);
        if (is_null($attribute)) {
            return null;
        }

        if (empty($attribute->values[0])) {
            return null;
        }

        return $attribute->values[0];
    }
}