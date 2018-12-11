<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 11.12.18
 * Time: 17:13
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\ProductGroup;

/**
 * Class ProductGroupsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductGroupsMapper extends Mapper
{
    /**
     * @param array $array
     *
     * @return ProductGroup
     */
    protected function doCreateObject(array $array)
    {
        return new ProductGroup(isset($array['attributes']) && is_array($array['attributes']) ? $array['attributes'] : $array);
    }
}
