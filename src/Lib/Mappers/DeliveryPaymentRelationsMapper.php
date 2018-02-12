<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\DeliveryPaymentRelation;

/**
 * Class DeliveryPaymentRelationsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class DeliveryPaymentRelationsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return DeliveryPaymentRelation
     */
    protected function doCreateObject(array $array)
    {
        return new DeliveryPaymentRelation($array);
    }
    #endregion
}
