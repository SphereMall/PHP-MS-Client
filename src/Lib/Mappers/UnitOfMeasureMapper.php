<?php
/**
 * Created by PhpStorm.
 * User: [Viktor Matushevskyi](mailto:v.matushevskyi@spheremall.com)
 * Date: 17.04.2018
 * Time: 16:22
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\UnitOfMeasure;

/**
 * Class UnitOfMeasureMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class UnitOfMeasureMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return UnitOfMeasure
     */
    protected function doCreateObject(array $array)
    {
        return new UnitOfMeasure($array);
    }
    #endregion
}