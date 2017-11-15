<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Entities\Product;
use SphereMall\MS\Resources\Resource;

/**
 * Class ProductsResource
 * @package SphereMall\MS\Resources\Products
 * @method Product get(int $id)
 * @method Product[] all()
 * @method Product update()
 * @method Product create()
 */
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
     * @return Product[]
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