<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Shop;

use InvalidArgumentException;
use SphereMall\MS\Client;
use SphereMall\MS\Entities\Address;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Entities\User;
use SphereMall\MS\Exceptions\EntityNotFoundException;

/**
 * Class Basket
 * @package SphereMall\MS\Lib\Shop
 */
class Basket extends OrderFinalized
{
    #region [Properties]
    private $updateParams = [];
    #endregion

    #region [Constructor]
    /**
     * Shop constructor.
     * @param Client $client
     * @param null|int $id
     * @throws EntityNotFoundException
     */
    public function __construct(Client $client, int $id = null)
    {
        parent::__construct($client);

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
            throw new InvalidArgumentException("Can not delete items. Shop is not created.");
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
            throw new InvalidArgumentException("Can not set delivery. Delivery id is empty.");
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

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        if (!$user->id) {
            throw new InvalidArgumentException("Can set user. User id is empty.");
        }

        $this->updateParams['userId'] = $user->id;

        return $this;
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
     * @param Address $address
     * @param string $addressKey
     */
    protected function setAddress(Address $address, $addressKey)
    {
        if (!$address->id) {
            $addressResource = $this->client
                ->addresses()
                ->create($address->asArray());

            if ($addressResource) {
                $address = $addressResource;
            }
        }

        $this->updateParams["{$addressKey}Id"] = $address->id;
    }

    /**
     * @param callable $action
     * @param array $params
     */
    protected function callResourceAction(callable $action, array $params)
    {
        $params['basketId'] = $this->getId();

        if (isset($params['products'])) {
            $params['products'] = json_encode($params['products']);
        }

        $order = call_user_func($action, $params);

        $this->setProperties($order);
    }
    #endregion
}