<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\AttributeGroupsEntities;

/**
 * Class AttributeGroupsEntitiesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AttributeGroupsEntitiesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return AttributeGroupsEntities
     */
    protected function doCreateObject(array $array)
    {
        $attributeGroup = new AttributeGroupsEntities($array);

        return $attributeGroup;
    }
    #endregion
}
