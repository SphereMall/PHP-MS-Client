<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Shop;

use SphereMall\MS\Entities\DeliveryProvider;

/**
 * Class Delivery
 * @package SphereMall\MS\Lib\Shop
 * @property DeliveryProvider $deliveryProvider
 */
class Delivery
{
    #region [Properties]
    public    $id;
    protected $deliveryProvider;
    #endregion

    #region [Constructor]
    public function __construct(DeliveryProvider $deliveryProvider)
    {
        $this->deliveryProvider = $deliveryProvider;
        $this->id               = $deliveryProvider->id;
    }
    #endregion

    #region [Public methods]
    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->deliveryProvider->cost;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->deliveryProvider->name;
    }
    #endregion
}
