<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\PaymentMethod;

/**
 * Class PaymentMethodsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PaymentMethodsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return PaymentMethod
     */
    protected function doCreateObject(array $array)
    {
        return new PaymentMethod($array);
    }
    #endregion
}