<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Option;

/**
 * Class OptionsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class OptionsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Option
     */
    protected function doCreateObject(array $array)
    {
        return new Option(is_array($array['attributes']) ? $array['attributes'] : $array);
    }
    #endregion
}
