<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\UserTriggerHistory;
use SphereMall\MS\Resources\Resource;

/**
 * Class UserTriggerHistoryResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method UserTriggerHistory get(int $id)
 * @method UserTriggerHistory first()
 * @method UserTriggerHistory[] all()
 * @method UserTriggerHistory update($id, $data)
 * @method UserTriggerHistory create($data)
 */
class UserTriggerHistoryResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "usertriggerhistory";
    }
}
