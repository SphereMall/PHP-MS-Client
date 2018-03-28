<?php
/**
 * Project PHP-MS-Client.
 * File: SearchInterface.php
 * Created by Sergey Yanchevsky
 * 27.02.2018 12:02
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;

/**
 * Interface SearchInterface
 * @package SphereMall\MS\Lib\Filters\Interfaces
 */
interface SearchInterface
{
    /**
     * @return array
     */
    public function getValues();
}
