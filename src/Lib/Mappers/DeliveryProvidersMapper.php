<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\DeliveryProvider;

class DeliveryProvidersMapper extends Mapper
{
    #region [Protected methods]
    protected function doCreateObject(array $array)
    {
        $deliveryProvider = new DeliveryProvider($array);
        return $deliveryProvider;
    }
    #endregion
}