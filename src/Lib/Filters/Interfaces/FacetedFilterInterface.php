<?php
/**
 * Project PHP-MS-Client.
 * File: SearchFilter.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 13:04
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface FacetedFilterInterface
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface FacetedFilterInterface
{
    /**
     * @return array
     */
    public function getSearchFilters();
}
