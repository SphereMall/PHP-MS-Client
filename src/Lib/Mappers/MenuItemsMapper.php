<?php

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\MenuItem;

/**
 * Class MenuItemMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class MenuItemsMapper extends Mapper
{
    /**
     * @param array $array Raw data
     * @return MenuItem
     */
    protected function doCreateObject(array $array)
    {
        return new MenuItem($array);
    }
}