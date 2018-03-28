<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\User;

/**
 * Class UsersMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class UsersMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return User
     */
    protected function doCreateObject(array $array)
    {
        return new User($array);
    }
    #endregion
}
