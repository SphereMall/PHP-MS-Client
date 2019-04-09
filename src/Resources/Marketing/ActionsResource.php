<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:27
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\Action;
use SphereMall\MS\Resources\Resource;

/**
 * Class ActionsResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method Action get(int $id)
 * @method Action first()
 * @method Action[] all()
 * @method Action update($id, $data)
 * @method Action create($data)Action
 */
class ActionsResource extends Resource
{
    function getURI()
    {
        return "actions";
    }
}
