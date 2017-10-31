<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

class Entity
{
    public function __construct($data)
    {
        foreach ($data as $optionKey => $optionValue) {
            if (property_exists($this, $optionKey)) {
                $this->{$optionKey} = $optionValue;
            }
        }
    }

    public function asArray()
    {
       return get_object_vars($this);
    }
}