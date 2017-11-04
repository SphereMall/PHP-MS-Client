<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:24 PM
 */

namespace SphereMall\MS\Lib\Specifications\Basic;

/**
 * Interface FilterSpecification
 * @package SphereMall\MS\Lib\Specifications
 */
interface FilterSpecification
{
    /**
     * @return array
     */
    public function asFilter();
}