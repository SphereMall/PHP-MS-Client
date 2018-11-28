<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 11:47
 */

namespace SphereMall\MS\Lib\FilterParams\Interfaces;

/**
 * Interface AttributesValuesParams
 *
 * @package SphereMall\MS\Lib\FilterParams\Interfaces
 */
interface AttributesValuesParams
{
    /**
     * @return array
     */
    public function getValues();

    /**
     * @return string
     */
    public function getParamName();
}
