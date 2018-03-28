<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\PaymentProvider;

/**
 * Class PaymentProvidersMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PaymentProvidersMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return PaymentProvider
     */
    protected function doCreateObject(array $array)
    {
        return new PaymentProvider($array);
    }
    #endregion
}
