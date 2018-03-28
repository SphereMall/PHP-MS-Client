<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\CurrencyRate;

/**
 * Class CurrenciesRateMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class CurrenciesRateMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return CurrencyRate
     */
    protected function doCreateObject(array $array)
    {
        return new CurrencyRate($array);
    }
    #endregion
}
