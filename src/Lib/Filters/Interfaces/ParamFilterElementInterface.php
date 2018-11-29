<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 16:46
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface ParamFilterElementInterface
 *
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface ParamFilterElementInterface
{
    /**
     * @return array
     */
    public function getParams(): array;
}
