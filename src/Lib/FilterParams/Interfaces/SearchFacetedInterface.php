<?php
/**
 * Project PHP-MS-Client.
 * File: SearchFacetedInterface.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 11:57
 */

namespace SphereMall\MS\Lib\FilterParams\Interfaces;

/**
 * Interface SearchFacetedInterface
 * @package SphereMall\MS\Lib\FilterParams\Interfaces
 */
interface SearchFacetedInterface
{
    /**
     * @return mixed
     */
    public function getFacetedParams();
}
