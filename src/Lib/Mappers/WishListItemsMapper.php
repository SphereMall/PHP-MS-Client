<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\WishListItem;

/**
 * Class WishListItemsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class WishListItemsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return WishListItem
     */
    protected function doCreateObject(array $array)
    {
        $orderItem = new WishListItem($array);
        if (isset($array['products'][0])) {
            $productMapper = new ProductsMapper();

            if (isset($array['images'])) {
                $array['products'][0]['images'] = $array['images'];
            }

            $orderItem->product = $productMapper->createObject($array['products'][0]);
        }
        return $orderItem;
    }
    #endregion
}