<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\User;
use SphereMall\MS\Resources\Resource;

/**
 * Class UsersResource
 * @package SphereMall\MS\Resources\Users
 * @method User get(int $id)
 * @method User[] all()
 * @method User update()
 * @method User create()
 */
class UsersResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "users";
    }
    #endregion
}