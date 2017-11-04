<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Basket;

use InvalidArgumentException;
use SphereMall\MS\Client;
use SphereMall\MS\Entities\Address;
use SphereMall\MS\Entities\DeliveryProvider;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Entities\User;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Async\AsyncContainer;
use SphereMall\MS\Lib\Collection;

/**
 * Class Basket
 * @package SphereMall\MS\Lib\Basket
 * @property Client $client
 * @property int $id
 * @property string $orderId
 * @property Collection $items
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
class Basket
{
    #region [Properties]
    public $items;
    public $subTotalVatPrice;
    public $totalVatPrice;
    public $subTotalPrice;
    public $totalPrice;
    public $totalPriceWithoutDelivery;

    protected $client;
    protected $id;
    protected $orderId;
    protected $delivery;

    protected $shippingAddress;
    protected $billingAddress;

    protected $paymentMethod;

    protected $user;

    protected $statusId;
    protected $paymentStatusId;

    private $updateParams = [];
    #endregion

    #region [Constructor]
    /**
     * Basket constructor.
     * @param Client $client
     * @param null|int $id
     * @throws EntityNotFoundException
     */
    public function __construct(Client $client, int $id = null)
    {
        $this->client = $client;

        if (!is_null($id)) {
            $this->id = $id;
            $this->get($this->id);
        }
    }
    #endregion

    #region [Public methods]
    /**
     * @param array $params
     */
    public function add(array $params)
    {
        if (is_null($this->getId())) {
            $this->createBasket();
        }

        $this->callResourceAction(function ($params) {
            return $this->client
                ->basketResource()
                ->create($params);
        }, $params);
    }

    /**
     * @param array $params
     */
    public function remove(array $params)
    {
        if (is_null($this->getId())) {
            throw new InvalidArgumentException("Can not delete items. Basket is not created.");
        }

        $this->callResourceAction(function ($params) {
            return $this->client
                ->basketResource()
                ->removeItems($params);
        }, $params);
    }

    /**
     * @param array $params
     */
    public function update(array $params = [])
    {
        if (is_null($this->getId())) {
            $this->createBasket();
        }

        $params = array_merge($params, $this->updateParams);

        $this->callResourceAction(function ($params) {
            return $this->client
                ->basketResource()
                ->update($this->getId(), $params);
        }, $params);

        $this->updateParams = [];
    }

    #endregion

    #region [Setters]
    /**
     * @param $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->updateParams['paymentMethodId'] = $paymentMethod;
        return $this;
    }

    /**
     * @param Delivery $delivery
     * @return $this
     */
    public function setDelivery(Delivery $delivery)
    {
        if (!$delivery->id) {
            throw new InvalidArgumentException("Can set delivery. Delivery id is empty.");
        }

        $this->updateParams['deliveryProviderId'] = $delivery->id;
        $this->updateParams['deliveryCost'] = $delivery->getCost();

        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setShippingAddress(Address $address)
    {
        $this->setAddress($address, 'shippingAddress');
        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setBillingAddress(Address $address)
    {
        $this->setAddress($address, 'billingAddress');
        return $this;
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
    protected function createBasket()
    {
        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->new([]);

        $this->id = $order->id;
    }

    /**
     * @param int $id
     * @throws EntityNotFoundException
     */
    protected function get(int $id)
    {
        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->get($id);

        if (is_null($order)) {
            throw new EntityNotFoundException("Can not found basket with id: $id");
        }

        $this->setProperties($order);
    }

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
    #endregion

    #region [Private functions]
    /**
     * @param Address $address
     * @param string $addressKey
     */
    private function setAddress(Address $address, $addressKey)
    {
        if (!$address->id) {
            $addressResource = $this->client
                ->addresses()
                ->create($address->asArray());

            if ($addressResource->count()) {
                $address = $addressResource->current();
            }
        }

        $this->updateParams["{$addressKey}Id"] = $address->id;
    }

    /**
     * @param callable $action
     * @param array $params
     */
    private function callResourceAction(callable $action, array $params)
    {
        $params['basketId'] = $this->getId();

        if (isset($params['products'])) {
            $params['products'] = json_encode($params['products']);
        }

        $orderCollection = call_user_func($action, $params);

        $this->setProperties($orderCollection->current());
    }

    /**
     * @param Order $order
     */
    private function setAsyncProperties(Order $order)
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

        if ($billingAddressId = $order->billingAddressId) {
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

        if (isset($asyncResult['deliveryProvider']) && $asyncResult['deliveryProvider']->count()) {
            $provider = $asyncResult['deliveryProvider']->current();
            $this->delivery = new Delivery(new DeliveryProvider([
                'id'   => $provider->id,
                'cost' => $order->deliveryCost,
                'name' => $provider->name,
            ]));
        }

        if (isset($asyncResult['shippingAddress']) && $asyncResult['shippingAddress']->count()) {
            $this->shippingAddress = $asyncResult['shippingAddress']->current();
        }

        if (isset($asyncResult['billingAddress']) && $asyncResult['billingAddress']->count()) {
            $this->billingAddress = $asyncResult['billingAddress']->current();
        }

        if (isset($asyncResult['user']) && $asyncResult['user']->count()) {
            $this->user = $asyncResult['user']->current();
        }
    }
    #endregion
}