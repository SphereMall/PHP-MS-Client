<?php
/**
 * Created by PHPStorm.
 * Yaroslav Draha
 */

namespace SphereMall\MS\Lib\Specifications\Users;

use SphereMall\MS\Entities\User;
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;

/**
 * Class IsActive
 * @package SphereMall\MS\Lib\Specifications\Basic
 * @property string $email
 * @property string $password
 */
class IsUserRegistered implements FilterSpecification
{
    #region [Properties]
    private $email;

    /**
     * Encoded password
     * @var
     */
    private $password;
    #endregion

    #region [Constructor]
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = md5($password);
    }
    #endregion

    #region [Implementations]
    /**
     * @return array
     */
    public function asFilter()
    {
        return [
            'email' => [FilterOperators::EQUAL => $this->email],
            'password' => [FilterOperators::EQUAL => $this->password]
        ];
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $this->email === $user->email && $this->password === $user->password;
    }
    #endregion
}