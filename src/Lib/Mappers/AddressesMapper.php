<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Address;

/**
 * Class AddressesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class AddressesMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return Address
     */
    protected function doCreateObject(array $array)
    {
        $address = new Address($array);
        return $address;
    }
    #endregion
}