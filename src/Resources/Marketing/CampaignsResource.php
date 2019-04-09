<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\Campaign;
use SphereMall\MS\Resources\Resource;

/**
 * Class CampaignsResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method Campaign get(int $id)
 * @method Campaign first()
 * @method Campaign[] all()
 * @method Campaign update($id, $data)
 * @method Campaign create($data)
 */
class CampaignsResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "campaigns";
    }
}
