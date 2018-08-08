<?php
/**
 * Created by PhpStorm.
 * User: DimaSarno
 * Date: 08.08.2018
 * Time: 10:53
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\ProductVariants;

/**
class ProductVariantsMapper extends Mapper
{
/**
 * @param array $array
 * @return ProductVariants
 */
class ProductVariantsMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        return new ProductVariants($array);
    }
}