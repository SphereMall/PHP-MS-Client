<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Services\Products\Entities;

use SphereMall\MS\Entity;

class Product extends Entity
{
    public static function getEntityName()
    {
        return 'products';
    }

}