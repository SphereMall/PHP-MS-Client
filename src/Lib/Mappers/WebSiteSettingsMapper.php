<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 20:13
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\WebSiteSetting;

class WebSiteSettingsMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        return new WebSiteSetting($array);
    }
}