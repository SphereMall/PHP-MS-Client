<?php
/**
 * Created by PhpStorm.
 * User: davidych
 * Date: 28.11.18
 * Time: 17:42
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface AttributeValuesInterface
 *
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface AttributeValuesInterface
{
    /**
     * @return string
     */
    public function getFieldName();

    /**
     * @return array
     */
    public function getFieldValues();
}
