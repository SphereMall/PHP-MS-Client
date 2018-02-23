<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 22.02.2018
 * Time: 11:33
 */

namespace SphereMall\MS\Lib\SortParams;

/**
 * Class SortParams
 * @package SphereMall\MS\Lib\SortParams
 * @property string $order
 */
abstract class SortParams
{
    protected $order = 'asc';

    abstract public function getParams();
}
