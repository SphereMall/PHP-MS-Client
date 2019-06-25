<?php
namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Objects\CashBackObject;

class CashBackObjectMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        return new CashBackObject($array);
    }
}