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
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Resources\Traits\FullResource;

/**
 * Class ProductsResource
 * @package SphereMall\MS\Resources\Products
 * @method Product get(int $id)
 * @method Product first()
 * @method Product[] all()
 * @method Product update($id, $data)
 * @method Product create($data)
 * @method Product|Product[] full($param = null)
 * @method Product[] fullAll()
 * @method Product fullById(int $id)
 * @method Product fullByCode(string $code)
 */
class ProductsResource extends Resource
{
    use FullResource;

    #region [Override methods]
    public function getURI()
    {
        return "products";
    }
    #endregion
}