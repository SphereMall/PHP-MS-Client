<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Collection;

class ProductsMapper extends Mapper
{
    #region [Protected methods]
    protected function doCreateObject(array $array)
    {
        $product = new Product($array);

        if (isset($array['productAttributeValues'])) {
            $mapper = new ProductAttributeValuesMapper();
            $attributes = $mapper->createObject($array['productAttributeValues']);
            $product->attributes = new Collection($attributes);
        }

        return $product;
    }
    #endregion
}