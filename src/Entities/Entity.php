<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

use ReflectionClass;

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
    public function __construct(array $data = [])
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
     * @param $name
     * @return bool
     */
    public function getProperty($name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return null;
    }

    /**
     * @return array
     */
    public function asArray()
    {
        $properties = [];
        foreach ($this as $key => $value) {
            if ($key == 'properties') {
                continue;
            }
            $properties[$key] = $value;
        }

        return array_merge($properties, $this->properties);
    }

    public function getType()
    {
        return strtolower((new ReflectionClass(get_called_class()))->getShortName());
    }

    /**
     * @param $name
     * @return bool
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }
    #endregion
}