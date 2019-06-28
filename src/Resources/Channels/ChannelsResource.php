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
class ChannelsResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "channels";
    }
    #endregion

    #region [Public methods]
    /**
     * @param string $url
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     * @throws \Exception
     */
    public function getBuURL(string $url)
    {
        $uriAppend = "detail/url/{$url}";
        $params = $this->getQueryParams();

        $response = $this->handler->handle('GET', false, $uriAppend, $params);

        return $this->make($response);
    }
    #endregion
}
