<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.03.2019
 * Time: 10:56
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\ActionType;

/**
 * Class ActionsTypesMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class ActionsTypesMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return ActionType
     */
    protected function doCreateObject(array $array)
    {
        return new ActionType(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
