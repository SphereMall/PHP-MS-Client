<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 23.02.2018
 * Time: 15:28
 */

namespace SphereMall\MS\Lib\FieldsParams;

/**
 * Class FieldsParams
 * @package SphereMall\MS\Lib\FieldsParams
 * @property array $fields
 */
abstract class FieldsParams
{
    protected $fields = [];

    abstract public function getFields();
}
