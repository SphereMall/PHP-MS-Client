<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:58
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\UserTriggerHistory;

/**
 * Class UserTriggerHistoryMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class UserTriggerHistoryMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return UserTriggerHistory
     */
    protected function doCreateObject(array $array)
    {
        return new UserTriggerHistory(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
