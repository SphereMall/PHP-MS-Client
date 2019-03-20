<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Trigger;

/**
 * Class TriggersMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class TriggersMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return Trigger
     */
    protected function doCreateObject(array $array)
    {
        return new Trigger(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
