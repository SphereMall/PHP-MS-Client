<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\Message;
use SphereMall\MS\Resources\Resource;

/**
 * Class CompaniesResource
 * @package SphereMall\MS\Resources\Users
 * @method Message get(int $id)
 * @method Message first()
 * @method Message[] all()
 * @method Message update($id, $data)
 * @method Message create($data)
 */
class MessagesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "messages";
    }
    #endregion
}