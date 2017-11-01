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
    protected $client;
    protected $id;
    protected $orderId;
    protected $delivery;

    protected $shippingAddress;
    protected $billingAddress;

    protected $paymentMethod;

    protected $statusId;
    protected $paymentStatusId;

    public $items;
    public $subTotalVatPrice;
    public $totalVatPrice;
    public $subTotalPrice;
    public $totalPrice;
    public $totalPriceWithoutDelivery;
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
     * @param array $products
     */
    public function add(array $products)
    {
        if (is_null($this->getId())) {
            $this->createBasket();
        }

        $params = $this->getProductParams($products);

        $orderCollection = $this->client
            ->basketResource()
            ->create($params);

        $this->setProperties($orderCollection->current());
    }

    /**
     * @param array $products
     */
    public function remove(array $products)
    {
        if (is_null($this->getId())) {
            throw new InvalidArgumentException("Can not delete items. Basket is not created.");
        }

        $params = $this->getProductParams($products);

        $orderCollection = $this->client
            ->basketResource()
            ->removeItems($params);

        $this->setProperties($orderCollection->current());

    }

    /**
     * @param array $params
     */
    public function update(array $params)
    {
        if (is_null($this->getId())) {
            throw new InvalidArgumentException("Can not update items. Basket is not created.");
        }

        $params['basketId'] = $this->getId();

        $orderCollection = $this->client
            ->basketResource()
            ->update($this->getId(), $params);

        $this->setProperties($orderCollection->current());
    }

    #endregion

    #region [Setters]

    public function setPaymentMethod($paymentMethod)
    {
        $params = [
            'paymentMethodId' => $paymentMethod
        ];

        $this->update($params);

        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @param Delivery $delivery
     */
    public function setDelivery(Delivery $delivery)
    {
        if (!$delivery->id) {
            throw new InvalidArgumentException("Can set delivery. Delivery id is empty.");
        }

        $this->delivery = $delivery;

        $params = [
            'deliveryProviderId' => $this->delivery->id,
            'deliveryCost'       => $this->delivery->getCost()
        ];

        $this->update($params);
    }

    /**
     * @param Address $address
     * @param string $addressKey
     */
    public function setShippingAddress(Address $address, $addressKey = 'shippingAddress')
    {
        if (!$address->id) {
            $addressResource = $this->client
                ->addresses()
                ->create($address->asArray());

            if ($addressResource->count()) {
                $this->{$addressKey} = $addressResource->current();
            }
        } else {
            $this->{$addressKey} = $address;
        }

        $params = [
            "{$addressKey}Id" => $this->{$addressKey}->id
        ];

        $this->update($params);
    }

    /**
     * @param Address $address
     */
    public function setBillingAddress(Address $address)
    {
        $this->setShippingAddress($address, 'billingAddress');
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
    }
    #endregion

    #region [Private functions]
    private function getProductParams(array $products)
    {
        $params = [
            'products' => json_encode(array_map(function ($product) {
                return [
                    'id'     => $product['id'],
                    'amount' => $product['amount'] ?? 1,
                ];
            }, $products)),
        ];

        $basketId = $this->getId();
        $params['basketId'] = $basketId;

        return $params;
    }
    #endregion
}