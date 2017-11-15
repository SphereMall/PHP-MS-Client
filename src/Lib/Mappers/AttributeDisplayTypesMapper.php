<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\AttributeDisplayType;

/**
 * Class AttributeDisplayTypesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AttributeDisplayTypesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return AttributeDisplayType
     */
    protected function doCreateObject(array $array)
    {
        $attributeDisplayType = new AttributeDisplayType($array);
        return $attributeDisplayType;
    }
    #endregion
}