<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Shop;

use SphereMall\MS\Entities\Vat;
use SphereMall\MS\Resources\Resource;

/**
 * Class VatsResource
 * @package SphereMall\MS\Resources\Shop
 * @method Vat get(int $id)
 * @method Vat[] all()
 * @method Vat update($id, $data)
 * @method Vat create($data)
 */
class VatsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "vat";
    }
    #endregion
}