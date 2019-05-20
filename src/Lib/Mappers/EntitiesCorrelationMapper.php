<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy Vorobey
 * Date: 02.04.2019
 * Time: 13:33
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\EntitiesCorrelation;

/**
 * Class EntityCorrelationMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class EntitiesCorrelationMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return null
     */
    protected function doCreateObject(array $array)
    {
        return new EntitiesCorrelation($array);
    }
}
