<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.04.2019
 * Time: 10:48
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\History;

/**
 * Class HistoryMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class HistoryMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return History
     */
    protected function doCreateObject(array $array)
    {
        return new History(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
