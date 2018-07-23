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
    #region [Public methods]
    /**
     * @param int $id
     *
     * @return null|Attribute
     */
    public function getAttributeById(int $id)
    {
        return $this->getAttributeByFieldNameAndValue('id', $id);
    }

    /**
     * @param array $ids
     *
     * @return array|Attribute[]
     */
    public function getAttributesByIds(array $ids)
    {
        return $this->getAttributesByFieldNameAndValues('id', $ids);
    }

    /**
     * @param string $code
     *
     * @return null|Attribute
     */
    public function getAttributeByCode(string $code)
    {
        return $this->getAttributeByFieldNameAndValue('code', $code);
    }

    /**
     * @param array $codes
     *
     * @return array|Attribute[]
     */
    public function getAttributesByCodes(array $codes)
    {
        return $this->getAttributesByFieldNameAndValues('code', $codes);
    }

    /**
     * @param string $code
     *
     * @return null|AttributeValue
     */
    public function getFirstValueByAttributeCode(string $code)
    {
        $attribute = $this->getAttributeByCode($code);
        if (is_null($attribute)) {
            return null;
        }

        if (empty($value = reset($attribute->values))) {
            return null;
        }

        return $value;
    }
    #endregion

    #region [Protected methods]
    /**
     * @param string $fieldName
     * @param $value
     *
     * @return null|Attribute
     */
    protected function getAttributeByFieldNameAndValue(string $fieldName, $value)
    {
        if (empty($this->attributes)) {
            return null;
        }

        foreach ($this->attributes as $attribute) {
            if ($attribute->{$fieldName} == $value) {
                return $attribute;
            }
        }

        return null;
    }

    /**
     * @param string $fieldName
     * @param $values
     *
     * @return array|Attribute[]
     */
    protected function getAttributesByFieldNameAndValues(string $fieldName, $values)
    {
        $attributes = [];

        if (empty($values) || empty($this->attributes)) {
            return $attributes;
        }

        foreach ($this->attributes as $attribute) {
            if (in_array($attribute->{$fieldName}, $values)) {
                $attributes[] = $attribute;
            }
        }

        return $attributes;
    }
    #endregion
}
