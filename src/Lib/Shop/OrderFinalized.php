<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Shop;

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Address;
use SphereMall\MS\Entities\DeliveryProvider;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Entities\OrderItem;
use SphereMall\MS\Entities\User;
use SphereMall\MS\Lib\Async\AsyncContainer;
use SphereMall\MS\Lib\Collection;

/**
 * Class OrderFinalized
 * @package SphereMall\MS\Lib\Shop
 * @property Client $client
 * @property int $id
 * @property string $orderId
 * @property OrderItem[] $items
 * @property Delivery $delivery
 * @property Address $shippingAddress
 * @property Address $billingAddress
 * @property int $paymentMethod
 * @property User $user
 * @property int $statusId
 * @property int $paymentStatusId
 * @property int $subTotalVatPrice
 * @property int $totalVatPrice
 * @property int $subTotalPrice
 * @property int $totalPrice
 * @property int $totalPriceWithoutDelivery
 */
class OrderFinalized
{
    #region [Properties]
    public $items;
    public $subTotalVatPrice;
    public $totalVatPrice;
    public $subTotalPrice;
    public $totalPrice;
    public $totalPriceWithoutDelivery;

    protected $id;
    protected $orderId;
    protected $delivery;
    protected $shippingAddress;
    protected $billingAddress;
    protected $paymentMethod;
    protected $user;
    protected $statusId;
    protected $paymentStatusId;

    protected $client;
    #endregion

    #region [Constructor]
    /**
     * Shop constructor.
     * @param Client $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client;
    }
    #endregion

    #region [Setter]
    public final function setOrderData(Order $order)
    {
        if (get_called_class() != self::class) {
            throw new \InvalidArgumentException("Method can be call only by OrderFinalized entity");
        }
        $this->id = $order->id;
        $this->setProperties($order);
    }
    #endregion

    #region [Public methods]
    /**
     * @param array $params
     */
    public function update(array $params = [])
    {
        $params = array_intersect_key($params, array_flip(['statusId', 'orderId', 'paymentStatusId']));

        //Update current order with params
        $order = $this->client
            ->orders()
            ->update($this->getId(), $params);

        //Get order by current orderId with items
        $orderWithItems = $this->client->orders()->byId($this->getId());
        $order->items = $orderWithItems->items;

        //Set data to current order
        $this->setOrderData($order);
    }
    #endregion

    #region [Getters]
    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return Delivery
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @return int
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @return int
     */
    public function getPaymentStatusId()
    {
        return $this->paymentStatusId;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    #endregion

    #region [Protected methods]
    /**
     * @param Order $order
     */
    protected function setProperties(Order $order)
    {
        $this->orderId = $order->orderId;
        $this->statusId = $order->statusId;
        $this->paymentStatusId = $order->paymentStatusId;

        $this->items = $order->items;

        $this->subTotalVatPrice = $order->subTotalVatPrice;
        $this->totalVatPrice = $order->totalVatPrice;
        $this->subTotalPrice = $order->subTotalPrice;
        $this->totalPrice = $order->totalPrice;
        $this->totalPriceWithoutDelivery = $order->totalPrice;

        $this->paymentMethod = $order->paymentMethodId;

        //Get all existing data for basket by async request
        $this->setAsyncProperties($order);
    }

    /**
     * @param Order $order
     */
    protected function setAsyncProperties(Order $order)
    {
        $ac = new AsyncContainer($this->client);

        if ($deliveryProviderId = $order->deliveryProviderId) {
            $ac->setCall('deliveryProvider', function (Client $client) use ($deliveryProviderId) {
                return $client->deliveryProviders()->get($deliveryProviderId);
            });
        }

        if ($shippingAddressId = $order->shippingAddressId) {
            $ac->setCall('shippingAddress', function (Client $client) use ($shippingAddressId) {
                return $client->addresses()->get($shippingAddressId);
            });
        }

        if (($order->billingAddressId != $order->shippingAddressId) && $billingAddressId = $order->billingAddressId) {
            $ac->setCall('billingAddress', function (Client $client) use ($billingAddressId) {
                return $client->addresses()->get($billingAddressId);
            });
        }

        if ($userId = $order->userId) {
            $ac->setCall('user', function (Client $client) use ($userId) {
                return $client->users()->get($userId);
            });
        }

        /**
         * @var $asyncResult array[Collection]
         */
        $asyncResult = $ac->call();

        if (!empty($asyncResult['deliveryProvider'])) {
            $provider = $asyncResult['deliveryProvider'];
            $this->delivery = new Delivery(new DeliveryProvider([
                'id'   => $provider->id,
                'cost' => $order->deliveryCost,
                'name' => $provider->name,
            ]));
        }

        if (!empty($asyncResult['shippingAddress'])) {
            $this->shippingAddress = $asyncResult['shippingAddress'];
        }

        if ($order->billingAddressId == $order->shippingAddressId) {
            $this->billingAddress = $this->shippingAddress;
        } else {
            if (!empty($asyncResult['billingAddress'])) {
                $this->billingAddress = $asyncResult['billingAddress'];
            }
        }

        if (!empty($asyncResult['user'])) {
            $this->user = $asyncResult['user'];
        }
    }
    #endregion
}