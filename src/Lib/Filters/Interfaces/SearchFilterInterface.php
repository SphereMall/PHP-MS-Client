<?php
/**
 * Project PHP-MS-Client.
 * File: SearchFilter.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 13:04
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface SearchFilterInterface
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface SearchFilterInterface
{
    /**
     * @param array $body
     * @return mixed
     */
    public function getSearchFilters($body = []);
}
