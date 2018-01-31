<?php
/**
 * Created by: Yaroslav Draha
 */

namespace SphereMall\MS\Resources\Shop;


use SphereMall\MS\Resources\Resource;

/**
 * Class PromotionsResource
 * @package SphereMall\MS\Resources\Shop
 */
class PromotionsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "promotions";
    }
    #endregion

    #region [Public methods]
    public function applyCoupon($basketId, string $couponCode)
    {
        $params = [
            "basketId" => $basketId,
            "couponCode" => $couponCode
        ];

        $response = $this->handler->handle('POST', $params, 'apply');

        return $this->make($response, false);
    }
    #endregion
}