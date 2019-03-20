<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 08.03.2019
 * Time: 14:56
 */

namespace SphereMall\MS\Resources\Entities;

use SphereMall\MS\Entities\Category;
use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Resources\Traits\DetailResource;

/**
 * Class CategoriesResource
 *
 * @package SphereMall\MS\Resources\Entities
 * @method Category get(int $id)
 * @method Category first()
 * @method Category[] all()
 * @method Category update($id, $data)
 * @method Category create($data)
 * @method Category|Category[] detail($param = null)
 * @method Category[] detailAll()
 * @method Category detailById(int $id)
 * @method Category detailByCode(string $code)
 */
class CategoriesResource extends Resource
{
    use DetailResource;

    function getURI()
    {
        return "categories";
    }
}
