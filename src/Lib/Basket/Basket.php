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
use SphereMall\MS\Lib\Collection;

/**
 * Class Basket
 * @package SphereMall\MS\Lib\Basket
 * @property Client $client
 * @property int $id
 * @property Collection $items
 * @property Delivery $delivery
 * @property Address $shippingAddress
 * @property Address $billingAddress
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
    protected $delivery;

    protected $shippingAddress;
    protected $billingAddress;

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

        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->create($params);

        $this->setProperties($order);
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

        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->removeItems($params);

        $this->setProperties($order);

    }

    /**
     * @param array $products
     */
    public function update(array $products)
    {
        if (is_null($this->getId())) {
            throw new InvalidArgumentException("Can not update items. Basket is not created.");
        }

        $params = $this->getProductParams($products);

        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->update($this->getId(), $params);

        $this->setProperties($order);
    }
    #endregion

    #region [Setters]
    /**
     * @param Delivery $delivery
     * @throws EntityNotFoundException
     */
    public function setDelivery(Delivery $delivery)
    {
        if (!$delivery->id) {
            throw new InvalidArgumentException("Can set delivery. Delivery id is empty.");
        }

        $this->delivery = $delivery;

        $params = [
            'deliveryProviderId' => $this->delivery->id,
            'deliveryCost'       => $this->delivery->getCost(),
        ];

        //TODO: Should be one update method for basket
        $this->client
            ->orders()
            ->update($this->getId(), $params);

        $this->get($this->id);
    }

    public function setShippingAddress()
    {

    }

    public function setBillingAddress()
    {

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
        $this->items = $order->items;

        $this->subTotalVatPrice = $order->subTotalVatPrice;
        $this->totalVatPrice = $order->totalVatPrice;
        $this->subTotalPrice = $order->subTotalPrice;
        $this->totalPrice = $order->totalPrice;
        $this->totalPriceWithoutDelivery = $order->totalPrice;

        //Get all existing data for basket by async request
        if ($order->deliveryProviderId) {
            $this->delivery = new Delivery(new DeliveryProvider([
                'id'   => $order->deliveryProviderId,
                'cost' => $order->deliveryCost,
            ]));
        }

        /* $ac = new AsyncContainer($this->client);
         if ($deliveryProviderId = $order->deliveryProviderId) {
             $ac->setCall('delivery', function (Client $client) use ($deliveryProviderId) {
                 return $client->deliveryProviders()->get($deliveryProviderId);
             });
         }

         $asyncResult = $ac->call();

         if (isset($asyncResult['delivery']) && $asyncResult['delivery']->count()) {
             $this->delivery = $asyncResult['delivery']->current();
         }*/
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