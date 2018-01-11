<?php
/**
 * Created by PhpStorm.
 * User: SergeyBondarchuk
 * Date: 11.01.2018
 * Time: 12:33
 */

namespace SphereMall\MS\Lib\Helpers;

/**
 * Class CorrelationTypeHelper
 * @package SphereMall\MS\Lib\Helpers
 */
class CorrelationTypeHelper
{
    #region [Static methods]
    /**
     * @param string $className
     * @return string
     */
    public static function getGraphTypeByClass(string $className) : string
    {
        $type = (new ClassReflectionHelper($className))->getShortLowerCaseName();

        return $type . 's';
    }
    #endregion
}