<?php

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\CatalogItemAttribute;

/**
 * Class CatalogItemAttributesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class CatalogItemAttributesMapper extends Mapper
{

    /**
     * @param array $array
     * @return \SphereMall\MS\Entities\CatalogItemAttribute
     */
    protected function doCreateObject(array $array)
    {
        return new CatalogItemAttribute($array);
    }
}
