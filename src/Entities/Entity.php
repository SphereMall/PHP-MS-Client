<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class Entity
 * @package SphereMall\MS\Entities
 */
class Entity
{
    #region [Properties]
    protected $properties = [];
    #endregion

    #region [Constructor]
    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (empty($data)) {
            return $this;
        }

        foreach ($data as $optionKey => $optionValue) {
            if (property_exists($this, $optionKey)) {
                $this->{$optionKey} = $optionValue;
            } else {
                $this->properties[$optionKey] = $optionValue;
            }
        }

        return $this;
    }
    #endregion

    #region [Public methods]
    /**
     * Get value by name from property of class or $properties if value is not exist in class
     * @see $properties
     * @param $key
     * @return bool
     */
    public function getProperty($key)
    {
        if(isset($this->properties[$key]))
            return $this->properties[$key];

        return null;
    }
    /**
     * @return array
     */
    public function asArray()
    {
        return get_object_vars($this);
    }
    #endregion
}