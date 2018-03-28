<?php
/**
 * Project PHP-MS-Client.
 * File: FacetedInterface.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 12:03
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface FacetedInterface
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface FacetedInterface
{
    /**
     * @return array
     */
    public function getFacetedValues();

    public function getName();
}
