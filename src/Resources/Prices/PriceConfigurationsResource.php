<?php
/**
 * Created by PhpStorm.
 * User: RomanSydorchuk
 * Date: 2/25/2019
 * Time: 12:47 PM
 */

namespace SphereMall\MS\Resources\Prices;

use SphereMall\MS\Resources\Resource;

class PriceConfigurationsResource extends Resource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "priceconfigurations";
    }

    /**
     * @param $productId
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByProductId($productId)
    {
        $params = $this->getQueryParams();
        $uriAppend = "byproducts?productIds=$productId";
        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }
    #endregion

}