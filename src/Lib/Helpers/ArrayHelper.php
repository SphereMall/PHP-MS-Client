<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 06.11.2018
 * Time: 19:17
 */

namespace SphereMall\MS\Lib\Helpers;

/**
 * Class ArrayHelper
 * @package SphereMall\MS\Lib\Helpers
 */
class ArrayHelper
{
    /**
     * @param $data
     * @param bool $recursive
     * @return array
     */
    public static function convertToArray($data, $recursive = false)
    {
        $returnData = is_object($data) ? get_object_vars($data) : $data;

        if (!$recursive) {
            return $returnData;
        }

        foreach ($returnData as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $returnData[$key] = ArrayHelper::convertToArray($value);
            }
        }

        return $returnData;
    }
}