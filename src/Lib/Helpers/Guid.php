<?php

namespace SphereMall\MS\Lib\Helpers;

class Guid
{
    static function Generate()
    {
        $s = md5(uniqid(rand(),true));
        return  substr($s,0,8) . '-' .
            substr($s,8,4) . '-' .
            substr($s,12,4). '-' .
            substr($s,16,4). '-' .
            substr($s,20);
    }

    static function GenerateAlphanumeric()
    {
        $s = md5(uniqid(rand(),true));
        return  substr($s,0,8) .
            substr($s,8,4).
            substr($s,12,4) .
            substr($s,16,4) .
            substr($s,20);
    }
}