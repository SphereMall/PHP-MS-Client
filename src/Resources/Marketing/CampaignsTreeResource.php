<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\CampaignTree;
use SphereMall\MS\Resources\Resource;

/**
 * Class CampaignsTreeResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method CampaignTree first()
 * @method CampaignTree[] all()
 * @method CampaignTree update($id, $data)
 * @method CampaignTree create($data)
 */
class CampaignsTreeResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "campaignstree";
    }
}
