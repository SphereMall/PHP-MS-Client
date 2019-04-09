<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\EventActionCampaign;
use SphereMall\MS\Resources\Resource;

/**
 * Class EventActionCampaignResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method EventActionCampaign get(int $id)
 * @method EventActionCampaign first()
 * @method EventActionCampaign[] all()
 * @method EventActionCampaign update($id, $data)
 * @method EventActionCampaign create($data)
 */
class EventActionCampaignResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "eventactioncampaign";
    }
}
