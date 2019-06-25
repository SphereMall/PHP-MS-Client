<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Channels;

use SphereMall\MS\Entities\WebSite;
use SphereMall\MS\Resources\Resource;

/**
 * Class UsersResource
 * @package SphereMall\MS\Resources\Users
 * @method WebSite get(int $id)
 * @method WebSite first()
 * @method WebSite[] all()
 * @method WebSite update($id, $data)
 * @method WebSite create($data)
 */
class WebSitesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "websites";
    }
    #endregion
}
