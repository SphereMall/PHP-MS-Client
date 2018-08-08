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
use SphereMall\MS\Resources\Traits\DetailResource;
use SphereMall\MS\Resources\Traits\FullResource;
use SphereMall\MS\Resources\Traits\WithActions;

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
 * @method Product|Product[] detail($param = null)
 * @method Product[] detailAll()
 * @method Product detailById(int $id)
 * @method Product detailByCode(string $code)
 */
class ProductsResource extends Resource
{
    use FullResource;
    use DetailResource;
    use WithActions;
    #region [Override methods]

    /**
     * @return string
     */
    public function getURI()
    {
        return "products";
    }

    /**
     * @param $ids
     * @return array|\SphereMall\MS\Lib\Collection
     */
    public function getProductVariantsByIds($ids)
    {
        $uriAppend = 'detail/variants?ids=' . implode(',', $ids) . '&offset=0&&limit=1000';
        $response = $this->handler->handle('GET', false, $uriAppend);
        return $this->make($response);
    }
    #endregiona
}
