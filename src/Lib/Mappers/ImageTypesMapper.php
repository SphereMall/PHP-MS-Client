<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\MediaType;

/**
 * Class ImageTypesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ImageTypesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return MediaType
     */
    protected function doCreateObject(array $array)
    {
        return new MediaType($array);
    }
    #endregion
}
