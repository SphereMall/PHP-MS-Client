<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Lib\Collection;

/**
 * Class AttributesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AttributesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return Attribute
     */
    protected function doCreateObject(array $array)
    {
        $attribute = new Attribute($array);
        if (isset($array['attributeValues'])) {
            $mapper = new AttributeValuesMapper();
            foreach ($array['attributeValues'] as $item) {
                $attribute->values[] = $mapper->createObject($item);
            }
        }

        if (isset($array['attributeGroups'])) {
            $mapper = new AttributeGroupsMapper();
            $attribute->group = $mapper->createObject($array['attributeGroups']);
        }


        return $attribute;
    }
    #endregion
}