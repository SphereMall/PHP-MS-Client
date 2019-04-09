<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Campaign;

/**
 * Class CampaignsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class CampaignsMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return Campaign
     */
    protected function doCreateObject(array $array)
    {
        return new Campaign(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
