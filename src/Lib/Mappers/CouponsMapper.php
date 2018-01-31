<?php
/**
 * User: Yaroslav Draha
 */
namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Coupon;

/**
 * Class BasketMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class CouponsMapper extends OrdersMapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return Coupon
     */
    protected function doCreateObject(array $array)
    {
        return new Coupon($array);
    }
    #endregion
}