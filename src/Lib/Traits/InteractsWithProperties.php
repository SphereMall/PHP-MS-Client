<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/22/2017
 * Time: 2:50 PM
 */

namespace SphereMall\MS\Lib\Traits;

/**
 * Trait InteractsWithProperties
 * @package SphereMall\MS\Lib\Traits
 * @property array $properties
 */
trait InteractsWithProperties
{
    protected $properties = [];

    /**
     * Get value by name from $properties
     * @see $properties
     * @param string $name Property name
     * @return bool
     */
    public function getProperty(string $name)
    {
        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return null;
    }

    /**
     * Set value in $properties by name
     * @see $properties
     * @param string $name Property name
     * @return bool True on success
     */
    public function setProperty(string $name, $value)
    {
        if (isset($this->properties[$name])) {
            $this->properties[$name] = $value;
            return true;
        }

        return false;
    }

    /**
     * Get value by name from property of class or $properties (if class property don't exist)
     * @see $properties
     * @param string $name Property name
     * @return null|mixed
     */
    public function get(string $name)
    {
        if (empty($name)) {
            return null;
        }

        if (isset($this->{$name})) {
            return $this->{$name};
        }

        if (isset($this->properties[$name])) {
            return $this->properties[$name];
        }

        return null;
    }

    /**
     * Set $value for class property or $properties (if class property don't exist) by $name
     * Value will be overridden
     * @param string $name Property name
     * @param mixed $value Property value
     * @return bool True on success
     */
    public function set(string $name, $value)
    {
        if (empty($name)) {
            return false;
        }

        if (isset($this->{$name})) {
            $this->{$name} = $value;
        } else {
            $this->properties[$name] = $value;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getPropertiesField()
    {
        return $this->properties;
    }

    /**
     * @param $name
     */
    public function removeProperty($name)
    {
        if (isset($this->properties[$name])) {
            unset($this->properties[$name]);
        }
    }

    /**
     * Magic method
     * @param string $name
     * @return bool
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * Magic method
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public function __set($name, $value)
    {
        return $this->setProperty($name, $value);
    }

    /**
     * @param array $data
     */
    public function setPropertiesField(array $data)
    {
        foreach ($data as $optionKey => $optionValue) {
            $this->properties[$optionKey] = $optionValue;
        }
    }

    /**
     * @param array $data
     */
    public function setPropertyList(array $data)
    {
        foreach ($data as $optionKey => $optionValue) {
            if (property_exists($this, $optionKey)) {
                $this->{$optionKey} = $optionValue;
            } else {
                $this->properties[$optionKey] = $optionValue;
            }
        }
    }
}
