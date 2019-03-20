<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\CampaignTree;

/**
 * Class CampaignsTreeMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class CampaignsTreeMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return CampaignTree
     */
    protected function doCreateObject(array $array)
    {
        return new CampaignTree(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
