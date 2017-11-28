<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\OrderItem;
use SphereMall\MS\Resources\Resource;

/**
 * Class OrderItemsResource
 * @package SphereMall\MS\Resources\Shop
 * @method OrderItem get(int $id)
 * @method OrderItem first()
 * @method OrderItem[] all()
 * @method OrderItem update($id, $data)
 * @method OrderItem create($data)
 */
class OrderItemsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "orderitems";
    }
    #endregion
}