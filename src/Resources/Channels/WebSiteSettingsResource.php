<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Channels;

use SphereMall\MS\Entities\WebSiteSetting;
use SphereMall\MS\Resources\Resource;

/**
 * Class UsersResource
 * @package SphereMall\MS\Resources\Users
 * @method WebSiteSetting get(int $id)
 * @method WebSiteSetting first()
 * @method WebSiteSetting[] all()
 * @method WebSiteSetting update($id, $data)
 * @method WebSiteSetting create($data)
 */
class WebSiteSettingsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "websitesettings";
    }
    #endregion
}
