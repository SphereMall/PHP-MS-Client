<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:57
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\TriggerType;

/**
 * Class TriggersTypesMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class TriggersTypesMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return TriggerType
     */
    protected function doCreateObject(array $array)
    {
        return new TriggerType(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
