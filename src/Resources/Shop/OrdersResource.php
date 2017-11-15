<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Lib\Shop\OrderFinalized;
use SphereMall\MS\Resources\Resource;

/**
 * Class OrdersResource
 * @package SphereMall\MS\Resources\Shop
 * @method OrderFinalized get(int $id)
 * @method OrderFinalized[] all()
 * @method OrderFinalized update()
 * @method OrderFinalized create()
 */
class OrdersResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "orders";
    }
    #endregion

    #region [Public methods]
    /**
     * Get list of entities
     * @param $orderId
     * @return null|OrderFinalized
     */
    public function byOrderId($orderId)
    {
        $uriAppend = "byorderid/$orderId";
        $params = $this->getQueryParams();
        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        $orderCollection = $this->make($response);
        if ($orderCollection) {
            $orderFinalized = new OrderFinalized($this->client);
            $orderFinalized->setOrderData($orderCollection[0]);
            return $orderFinalized;
        }

        return null;
    }
    #endregion
}