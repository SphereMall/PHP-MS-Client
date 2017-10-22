<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources;

use SphereMall\MS\Lib\Collection;

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
     * @param null|int $id
     * @return Collection
     */
    public function full($id = null)
    {
        $uriAppend = 'full';
        $params = $this->getQueryParams();

        if (!is_null($id)) {
            $uriAppend = $uriAppend . "/$id";
        }

        $response = $this->handler->handle('GET', false, $uriAppend, $params);
        return $this->make($response);
    }
    #endregion
}