<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Resources\Resource;

class ProductsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "products";
    }
    #endregion

    #region [Public methods]
    /**
     * Get list of entities
     * @param null|int|string $param
     * @return Collection
     */
    public function full($param = null)
    {
        $uriAppend = 'full';
        $params = $this->getQueryParams();

        if (!is_null($param)) {
            $uriAppend = is_int($param)
                ? $uriAppend . "/$param"
                : "url/$param";
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }
    #endregion
}