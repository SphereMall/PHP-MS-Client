<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\OrderStatus;
use SphereMall\MS\Resources\Resource;

/**
 * Class OrderStatusesResource
 * @package SphereMall\MS\Resources\Shop
 * @method OrderStatus get(int $id)
 * @method OrderStatus[] all()
 * @method OrderStatus update($id, $data)
 * @method OrderStatus create($data)
 */
class OrderStatusesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "orderstatuses";
    }
    #endregion
}