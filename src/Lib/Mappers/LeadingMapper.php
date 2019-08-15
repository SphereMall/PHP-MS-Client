<?php
namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Pages\Leading;

class LeadingMapper extends Mapper
{
    protected function doCreateObject(array $array)
    {
        return new Leading($array);
    }
}