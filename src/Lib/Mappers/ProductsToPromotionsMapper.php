<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 15:53
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\ProductToPromotions;

/**
 * Class ProductsToPromotionsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductsToPromotionsMapper extends Mapper
{
    /**
     * @param array $array
     * @return ProductToPromotions
     */
    protected function doCreateObject(array $array)
    {
        return new ProductToPromotions($array);
    }
}