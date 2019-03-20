<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\UserTrigger;
use SphereMall\MS\Resources\Resource;

/**
 * Class UserTriggersResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method UserTrigger get(int $id)
 * @method UserTrigger first()
 * @method UserTrigger[] all()
 * @method UserTrigger update($id, $data)
 * @method UserTrigger create($data)
 */
class UserTriggersResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "usertriggers";
    }
}
