<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:15 PM
 */

namespace SphereMall\MS\Lib\Basket;

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Exceptions\EntityNotFoundException;
/**
 * Class Basket
 * @package SphereMall\MS\Lib\Basket
 * @property Client $client
 * @property int $id
 * @property array $items
 */
class Basket
{
    #region [Properties]
    protected $client;

    protected $id;
    protected $items = [];
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

        $params = [
            'products' => json_encode(array_map(function ($product) {
                return [
                    'id'     => $product['id'],
                    'amount' => isset($product['amount']) ? $product['amount'] : 1,
                ];
            }, $products)),
        ];

        $basketId = $this->getId();
        $params['basketId'] = $basketId;

        /**
         * @var Order $order
         */
        $order = $this->client
            ->basketResource()
            ->create($params);

        $this->setProperties($order);
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
     * @return array
     */
    public function getItems()
    {
        return $this->items;
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
    }
    #endregion
}