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
 *
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
        $order = new Order(is_array($array['attributes']) ? $array['attributes'] : $array);

        if (isset($array['items'])) {
            $orderItemMapper = new OrderItemsMapper();
            $order->items    = array_map(function ($item) use ($orderItemMapper) {
                return $orderItemMapper->createObject($item);
            }, $array['items']);
        }

        if (isset($array['relationships']['orderItems']) && is_array($array['relationships']['orderItems'])) {
            $mapper = new OrderItemsMapper();
            foreach ($array['relationships']['orderItems'] as $item) {
                $order->items[$item['id']] = $mapper->createObject($item);
            }
        }

        if (isset($array['relationships']['paymentMethods']) && is_array($array['relationships']['paymentMethods'])) {
            $mapper = new PaymentMethodsMapper();
            foreach ($array['relationships']['paymentMethods'] as $item) {
                $order->paymentMethods[$item['id']] = $mapper->createObject($item['attributes']);
            }
        }

        return $order;
    }
    #endregion
}
