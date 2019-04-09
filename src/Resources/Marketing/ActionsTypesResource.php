<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:52
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\ActionType;
use SphereMall\MS\Resources\Resource;

/**
 * Class ActionsTypesResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method ActionType get(int $id)
 * @method ActionType first()
 * @method ActionType[] all()
 * @method ActionType update($id, $data)
 * @method ActionType create($data)
 */
class ActionsTypesResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "actionstypes";
    }
}
