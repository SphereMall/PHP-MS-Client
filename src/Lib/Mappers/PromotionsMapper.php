<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 15:55
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Promotion;

/**
 * Class PromotionsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PromotionsMapper extends Mapper
{
    /**
     * @param array $array
     * @return Promotion
     */
    protected function doCreateObject(array $array)
    {
        return new Promotion(is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
