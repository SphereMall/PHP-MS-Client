<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:21
 */


namespace SphereMall\MS\Services\Products;

use SphereMall\MS\Services\BaseService;
use SphereMall\MS\Services\Products\Entities\Product;

class ProductService extends BaseService
{
    public static function registry()
    {
        parent::registryEntity(Product::class);
    }
}