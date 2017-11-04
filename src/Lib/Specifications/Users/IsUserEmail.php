<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:44 PM
 */

namespace SphereMall\MS\Lib\Specifications\Users;

use SphereMall\MS\Entities\User;
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;

/**
 * Class IsActive
 * @package SphereMall\MS\Lib\Specifications\Basic
 * @property string $email
 */
class IsUserEmail implements FilterSpecification, UserSpecification
{
    #region [Properties]
    private $email;
    #endregion

    #region [Constructor]
    public function __construct($email)
    {
        $this->email = $email;
    }
    #endregion

    #region [Implementations]
    /**
     * @return array
     */
    public function asFilter()
    {
        return ['email' => [FilterOperators::EQUAL => $this->email]];
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $this->email == $user->email;
    }
    #endregion
}