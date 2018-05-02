<?php
/**
 * Created by: Yaroslav Draha
 */

namespace SphereMall\MS\Resources\Shop;


use SphereMall\MS\Resources\Resource;

/**
 * Class CouponsResource
 * @package SphereMall\MS\Resources\Shop
 */
class PromotionsResource extends Resource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "promotions";
    }
    #endregion

    #region [Public methods]
    /**
     * Apply coupon code to basket
     * @param $basketId
     * @param string $couponCode
     * @return \GuzzleHttp\Promise\PromiseInterface|\SphereMall\MS\Lib\Http\Response
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function applyCoupon($basketId, string $couponCode)
    {
        $params = [
            "basketId"   => $basketId,
            "couponCode" => $couponCode,
        ];

        $response = $this->handler->handle('POST', $params, 'apply');

        //TODO: refactor to make method
        return $response;
//        return $this->make($response, false);
    }

    /**
     * Discard coupon code for basket
     * @param integer $basketId
     * @param string $couponCode
     * @param integer $userId
     * @return \GuzzleHttp\Promise\PromiseInterface|\SphereMall\MS\Lib\Http\Response
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelCoupon($basketId, string $couponCode, $userId)
    {
        $params = [
            "basketId" => $basketId,
            "couponCode" => $couponCode,
            "userId" => $userId
        ];

        $response = $this->handler->handle('POST', $params, 'discard');

        //TODO: refactor to make method
        return $response;
//        return $this->make($response, false);
    }

    /**
     * @param array $products
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function byIds(array $products){

        $response = $this->handler->handle('POST', $products, 'products/byids');
        return $this->make($response, true);
    }
    #endregion
}
