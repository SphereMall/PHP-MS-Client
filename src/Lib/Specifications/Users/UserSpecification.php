<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:24 PM
 */

namespace SphereMall\MS\Lib\Specifications\Users;

use SphereMall\MS\Entities\User;

/**
 * Interface UserSpecification
 * @package SphereMall\MS\Lib\Specifications
 */
interface UserSpecification
{
    /**
     * @param User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user);
}