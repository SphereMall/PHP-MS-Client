<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 1:31 PM
 */

namespace SphereMall\MS\Lib\Filters;

class FilterOperators
{
    const LIKE                  = 'l';
    const LIKE_LEFT             = 'll';
    const LIKE_RIGHT            = 'lr';
    const EQUAL                 = 'e';
    const NOT_EQUAL             = 'ne';
    const GREATER_THAN          = 'gt';
    const LESS_THAN             = 'lt';
    const GREATER_THAN_OR_EQUAL = 'gte';
    const LESS_THAN_OR_EQUAL    = 'lte';
    const IS_NULL               = 'is';
}
