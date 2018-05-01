<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 01.05.2018
 * Time: 12:47
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\DiscountType;

/**
 * Class DiscountTypesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class DiscountTypesMapper extends Mapper
{
    /**
     * @param array $array
     * @return DiscountType
     */
    protected function doCreateObject(array $array)
    {
        return new DiscountType($array);
    }
}
