<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\EntityAttribute;

/**
 * Class EntityAttributesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class EntityAttributesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return EntityAttribute
     */
    protected function doCreateObject(array $array)
    {
        return new EntityAttribute($array);
    }
    #endregion
}
