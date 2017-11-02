<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */
namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Collection;

/**
 * Class Order
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $orderId
 * @property int $userId
 * @property int $statusId
 * @property Collection $items
 */
class Order extends Entity
{
    #region [Properties]
    public $id;
    public $orderId;
    public $userId;
    public $statusId;
    public $paymentStatusId;
    public $paymentId;
    public $itemsAmount;
    public $deliveryProviderId;
    public $paymentMethodId;
    public $shippingAddressId;
    public $billingAddressId;
    public $deliveryTime;
    public $deliveryStatusId;
    public $currency;
    public $additionalInfo;
    public $orderComment;

    public $deliveryCost;
    public $subTotalVatPrice;
    public $totalVatPrice;
    public $subTotalPrice;
    public $totalPrice;
    public $totalPriceWithoutDelivery;

    public $items = [];

    public $createDate;
    public $updateDate;
    #endregion
}