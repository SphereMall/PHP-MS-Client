<?php
/**
 * Created by SergeyBondarchuk.
 * 30.03.2018 12:46
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\FactorValue;

/**
 * Class FactorValuesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class FactorValuesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return FactorValue
     */
    protected function doCreateObject(array $array)
    {
        return new FactorValue($array);
    }
    #endregion
}