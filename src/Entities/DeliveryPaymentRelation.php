<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class DeliveryPaymentRelation
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $deliveryProviderId
 * @property int $paymentMethodId
 */
class DeliveryPaymentRelation extends Entity
{
    #region [Properties]
    public $id;
    public $deliveryProviderId;
    public $paymentMethodId;
    #endregion
}