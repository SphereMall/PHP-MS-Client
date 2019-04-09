<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:55
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\Trigger;
use SphereMall\MS\Resources\Resource;

/**
 * Class TriggersResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method Trigger get(int $id)
 * @method Trigger first()
 * @method Trigger[] all()
 * @method Trigger update($id, $data)
 * @method Trigger create($data)
 */
class TriggersResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "triggers";
    }
}
