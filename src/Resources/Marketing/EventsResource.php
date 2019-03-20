<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:56
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\Event;
use SphereMall\MS\Resources\Resource;

/**
 * Class EventsResource
 *
 * @package SphereMall\MS\Resources\Marketing
 * @method Event get(int $id)
 * @method Event first()
 * @method Event[] all()
 * @method Event update($id, $data)
 * @method Event create($data)
 */
class EventsResource extends Resource
{
    /**
     * @return string
     */
    function getURI()
    {
        return "events";
    }
}
