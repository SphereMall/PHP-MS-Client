<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Client;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Lib\Makers\ObjectMaker;
use SphereMall\MS\Lib\Makers\OrdersMaker;
use SphereMall\MS\Resources\Resource;

/**
 * Class BasketResource
 *
 * @package SphereMall\MS\Resources\Shop
 */
class BasketResource extends Resource
{

    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "basket";
    }

    /**
     * BasketResource constructor.
     *
     * @param Client $client
     * @param null   $version
     * @param null   $handler
     * @param null   $maker
     * @param bool   $multi
     */
    public function __construct(Client $client, $version = null, $handler = null, $maker = null, bool $multi = false)
    {
        parent::__construct($client, $version, $handler, $maker, $multi);
        $this->maker = $this->version == 'v1' ? new OrdersMaker() : new ObjectMaker();
    }
    #endregion

    #region [Override CRUD]
    /**
     * Get entity by id
     *
     * @param int   $id
     * @param array $params
     *
     * @return Entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id, $params = [])
    {
        if ($this->fields) {
            $params['fields'] = implode(',', $this->fields);
        }

        $uriAppend = 'byId/' . $id;
        $response  = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response, false);
    }

    /**
     * @param $data
     *
     * @return Entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function new($data)
    {
        $response = $this->handler->handle('POST', $data, 'new');

        return $this->make($response, false);
    }

    /**
     * @param array $params
     *
     * @return Entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeItems(array $params)
    {
        $response = $this->handler->handle('DELETE', $params);

        return $this->make($response, false);
    }

    /**
     * @param $id
     * @param $data
     *
     * @return Entity
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($id, $data)
    {
        $response = $this->handler->handle('PUT', $data);

        return $this->make($response, false);
    }

    /**
     * @param $id
     *
     * @return array|int|Entity|\SphereMall\MS\Lib\Collection|Order
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function copy($id)
    {
        $uriAppend = 'copy/' . $id;

        $response = $this->handler->handle('POST', false, $uriAppend);

        return $this->make($response, false);
    }

    /**
     * @param        $basketId
     * @param string $couponCode
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\SphereMall\MS\Lib\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function applyCoupon($basketId, string $couponCode)
    {
        $params = [
            "basketId"   => $basketId,
            "couponCode" => $couponCode,
        ];

        return $this->handler->handle('POST', $params, 'applycoupon');
    }

    /**
     * @param $basketId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\SphereMall\MS\Lib\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelCoupon($basketId)
    {
        return $this->handler->handle('POST', ['basketId' => $basketId], 'discardcoupon');
    }
}
