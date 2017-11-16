<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Entities\FunctionalName;
use SphereMall\MS\Resources\Resource;

/**
 * Class FunctionalNamesResource
 * @package SphereMall\MS\Resources\Products
 * @method FunctionalName get(int $id)
 * @method FunctionalName[] all()
 * @method FunctionalName update($id, $data)
 * @method FunctionalName create($data)
 */
class FunctionalNamesResource extends Resource
{
    public function getURI()
    {
        return "functionalnames";
    }

}