<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Basket;

use SphereMall\MS\Entities\DeliveryProvider;

/**
 * Class Delivery
 * @package SphereMall\MS\Lib\Basket
 * @property DeliveryProvider $deliveryProvider
 */
class Delivery
{
    #region [Properties]
    public $id;
    protected $deliveryProvider;
    #endregion

    #region [Constructor]
    public function __construct(DeliveryProvider $deliveryProvider)
    {
        $this->deliveryProvider = $deliveryProvider;
        $this->id = $deliveryProvider->id;
    }
    #endregion
}