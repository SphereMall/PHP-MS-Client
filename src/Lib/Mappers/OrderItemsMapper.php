<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\OrderItem;

/**
 * Class BasketMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class OrderItemsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return OrderItem
     */
    protected function doCreateObject(array $array)
    {
        $orderItem = new OrderItem($array);
        if (isset($array['products']) && $product = reset($array['products'])) {

            if (isset($array['images'])) {
                $product['images'] = $array['images'];
            }

            $productMapper = new ProductsMapper();
            $orderItem->product = $productMapper->createObject($product);
        }

        return $orderItem;
    }
    #endregion
}
