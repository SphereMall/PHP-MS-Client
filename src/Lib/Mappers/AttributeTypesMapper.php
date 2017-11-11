<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\AttributeType;

class AttributeTypesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return AttributeType
     */
    protected function doCreateObject(array $array)
    {
        $attributeType = new AttributeType($array);
        return $attributeType;
    }
    #endregion
}