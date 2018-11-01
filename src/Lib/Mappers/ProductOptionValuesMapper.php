<?php

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\ProductOptionValue;

/**
 * Class ProductOptionValuesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductOptionValuesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return ProductOptionValue
     */
    protected function doCreateObject(array $array)
    {
        return new ProductOptionValue(is_array($array['attributes']) ? $array['attributes'] : $array);
    }
    #endregion
}
