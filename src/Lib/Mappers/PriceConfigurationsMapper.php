<?php
/**
 * Created by PhpStorm.
 * User: RomanSydorchuk
 * Date: 2/25/2019
 * Time: 2:39 PM
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\PriceConfigurations;

/**
 * Class PriceConfigurationsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PriceConfigurationsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return PriceConfigurations
     */
    protected function doCreateObject(array $array)
    {
        return new PriceConfigurations($array);
    }
    #endregion
}