<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\EventActionCampaign;

/**
 * Class EventActionCampaignMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class EventActionCampaignMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return EventActionCampaign
     */
    protected function doCreateObject(array $array)
    {
        return new EventActionCampaign(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
