<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\Address;
use SphereMall\MS\Resources\Resource;

/**
 * Class AddressResource
 * @package SphereMall\MS\Resources\Users
 * @method Address get(int $id)
 * @method Address[] all()
 * @method Address update($id, $data)
 * @method Address create($data)
 */
class AddressResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "addresses";
    }
    #endregion
}