<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 17:53
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Action;

/**
 * Class ActionsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class ActionsMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return Action
     */
    protected function doCreateObject(array $array)
    {
        return new Action(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
