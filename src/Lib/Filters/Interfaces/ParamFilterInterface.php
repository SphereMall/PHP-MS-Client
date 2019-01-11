<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 16:46
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface ParamFilterInterface
 *
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface ParamFilterInterface
{
    /**
     * @return array
     */
    public function getFilters(): array;
}
