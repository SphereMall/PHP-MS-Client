<?php
/**
 * Created by PhpStorm.
 * User: DimaSarno
 * Date: 10.08.2018
 * Time: 17:54
 */

namespace SphereMall\MS\Exceptions;


use Throwable;

class PropertyNotFoundException extends SMSDKException
{
    public function __construct(string $propertyName)
    {
        parent::__construct("Property {$propertyName} not found");
    }
}