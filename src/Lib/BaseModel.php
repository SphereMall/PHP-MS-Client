<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 06.11.2018
 * Time: 19:03
 */

namespace SphereMall\MS\Lib;

use SphereMall\MS\Lib\Traits\InteractsWithProperties;

abstract class BaseModel
{
    use InteractsWithProperties;

    /**
     * BaseModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (empty($data)) {
            return $this;
        }

        $this->setPropertyList($data);
        $this->injectRelations();

        return $this;
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

    protected function injectRelations()
    {
        foreach ($this->hasMany() as $property => $className) {
            if (property_exists($this, $property) && $this->{$property}) {
                $arrayOfObj = [];
                foreach ($this->{$property} as $key => $item) {
                    $arrayOfObj[$key] = new $className($item);
                }
                $this->{$property} = $arrayOfObj;
            }
        }

        foreach ($this->belongTo() as $property => $className) {
            if (property_exists($this, $property) && $this->{$property}) {
                $this->{$property} = new $className($this->{$property});
            }
        }
    }

    /**
     * @return array
     */
    protected function hasMany()
    {
        return [];
    }

    /**
     * @return array
     */
    protected function belongTo()
    {
        return [];
    }
}