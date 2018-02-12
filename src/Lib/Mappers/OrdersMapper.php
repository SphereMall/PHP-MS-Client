<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Order;

/**
 * Class BasketMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class OrdersMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Order
     */
    protected function doCreateObject(array $array)
    {
        $order = new Order($array);

        if (isset($array['items'])) {
            $orderItemMapper = new OrderItemsMapper();
            $order->items    = array_map(function ($item) use ($orderItemMapper) {
                return $orderItemMapper->createObject($item);
            }, $array['items']);
        }

        return $order;
    }
    #endregion
}
