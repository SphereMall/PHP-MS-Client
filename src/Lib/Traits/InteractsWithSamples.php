<?php
/**
 * Created by PhpStorm.
 * User: RomanSydorchuk
 * Date: 18.01.2019
 * Time: 11:58
 */

namespace SphereMall\MS\Lib\Traits;

use SM\Custom\system\Context;
use SphereMall\MS\Entities\Product;

/**
 * Trait InteractsWithSamples
 * @package SphereMall\MS\Lib\Traits
 */
trait InteractsWithSamples
{
    #region [Public static methods]
    /**
     * @param $productId
     * @return Product
     * @throws \Exception
     */
    public static function getProductSample($productId)
    {
        return Context::MSClient()->products()->getRelatedProducts($productId)[0] ?? null;
    }

    /**
     * @return int
     */
    public static function getProductSampleAmount()
    {
        return array_sum(array_map(function ($item) {
                return $item->product->functionalName->code == 'sample';
            }, Context::Basket()->basket->items ?? [])) ?? 0;
    }

    /**
     * @param $productSampleId
     * @return bool
     */
    public static function checkIfProductSampleSelected($productSampleId)
    {
        $basket = Context::Basket()->basket;
        if ($basket->items && $productSampleId) {
            foreach ($basket->items as $item) {
                if ($item->product->id == $productSampleId) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $productSampleId
     * @return bool
     */
    public static function permissionForAdding($productSampleId)
    {
        $isProductSampleSelected = self::checkIfProductSampleSelected($productSampleId);
        $productSampleAmount = self::getProductSampleAmount();

        return isset($productSampleId) && ($isProductSampleSelected ?? 0 xor $productSampleAmount >= 5) ? true : false;
    }

    public static function checkIfOnlySamples($totalItemAmount, $productSampleAmount)
    {
        return $totalItemAmount - $productSampleAmount == 0 ? true : false;
    }
    #endregion
}