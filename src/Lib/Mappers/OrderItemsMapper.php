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
        if (isset($array['products'][0])) {

            if (isset($array['images'])) {
                $array['products'][0]['images'] = $array['images'];
            }

//            // options
//            if (isset($array['options'][0]) && is_array($array['options'][0])) {
//                $optionMapper = new OptionsMapper();
//                $productOptionValuesMapper = new ProductOptionValuesMapper();
//                $options = [];
//
//                foreach ($array['options'] as $option) {
//                    $productOptionValues = array_filter($array['productOptionValues'] ?? [], function ($productOptionValue) use ($option) {
//                        return $option['id'] == $productOptionValue['optionId'];
//                    });
//
//                    foreach ($productOptionValues ?? [] as $productOptionValue) {
//                        $option['values'][] = $productOptionValuesMapper->createObject($productOptionValue);
//                    }
//
//                    $options[] = $optionMapper->createObject($option);
//                }
//
//                $array['products'][0]['options'] = $options;
//
//            }

            $productMapper = new ProductsMapper();
            $orderItem->product = $productMapper->createObject($array['products'][0]);
        }

        return $orderItem;
    }
    #endregion
}
