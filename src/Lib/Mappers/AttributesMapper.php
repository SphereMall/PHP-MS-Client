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

class AttributesMapper extends Mapper
{
    #region [Protected methods]
    protected function doCreateObject(array $array)
    {
        $attribute = new Attribute($array);
        if (isset($array['values'])) {
            $mapper = new AttributeValuesMapper();
            $values = [];
            foreach ($array['values'] as $item) {
                $values[] = $mapper->createObject($item);
            }

            $attribute->values = new Collection($values);
        }

        return $attribute;
    }
    #endregion
}