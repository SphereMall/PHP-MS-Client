<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS;

abstract class Entity
{
    abstract static function getEntityName();

    public function getClass()
    {
        return get_called_class();
    }
}