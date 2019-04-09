<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Event;

/**
 * Class EventsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class EventsMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return Event
     */
    protected function doCreateObject(array $array)
    {
        return new Event(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
