<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 20:13
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\WebSite;

class WebSitesMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        return new WebSite($array);
    }
}