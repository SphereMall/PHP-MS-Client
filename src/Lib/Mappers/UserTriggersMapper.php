<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:58
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\UserTrigger;

/**
 * Class UserTriggersMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class UserTriggersMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return UserTrigger
     */
    protected function doCreateObject(array $array)
    {
        return new UserTrigger(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
