<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\TriggerType;
use SphereMall\MS\Resources\Resource;

/**
 * Class TriggersTypesResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method TriggerType get(int $id)
 * @method TriggerType first()
 * @method TriggerType[] all()
 * @method TriggerType update($id, $data)
 * @method TriggerType create($data)
 */
class TriggersTypesResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "triggerstypes";
    }
}
