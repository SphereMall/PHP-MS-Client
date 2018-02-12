<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\AttributeGroup;

/**
 * Class AttributeGroupsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AttributeGroupsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return AttributeGroup
     */
    protected function doCreateObject(array $array)
    {
        $attributeGroup = new AttributeGroup($array);

        return $attributeGroup;
    }
    #endregion
}
