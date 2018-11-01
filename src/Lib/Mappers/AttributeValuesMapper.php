<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\AttributeValue;

/**
 * Class AttributeValuesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AttributeValuesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return AttributeValue
     */
    protected function doCreateObject(array $array)
    {
        return new AttributeValue(is_array($array['attributes']) ? $array['attributes'] : $array);
    }
    #endregion
}
