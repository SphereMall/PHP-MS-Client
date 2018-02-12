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
     * Get value by name from property of class or $properties if value is not exist in class
     * @see $properties
     *
     * @param $name
     *
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
     * @param $name
     *
     * @return bool
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * @param array $data
     */
    protected function setPropertiesField(array $data)
    {
        foreach ($data as $optionKey => $optionValue) {
            $this->properties[$optionKey] = $optionValue;
        }
    }

    /**
     * @param array $data
     */
    protected function setPropertyList(array $data)
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
