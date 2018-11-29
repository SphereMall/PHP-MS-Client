<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 13:49
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface ElasticConfigElementInterface
 *
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface ElasticConfigElementInterface
{
    /**
     * @return array
     */
    public function getElements(): array;
}
