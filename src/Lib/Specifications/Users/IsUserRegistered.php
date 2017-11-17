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
 * @property string $hash result of password_hash for verification
 */
class IsUserRegistered implements FilterSpecification
{
    #region [Properties]
    private $email;
    private $password;
    private $hash;
    #endregion

    #region [Constructor]
    /**
     * IsUserRegistered constructor.
     * @param string $email
     * @param string $password
     * @param string $hash - needed for verification
     */
    public function __construct(string $email, string $password, string $hash)
    {
        $this->email = $email;
        $this->password = $password;
        $this->hash = $hash;
    }
    #endregion

    #region [Implementations]
    /**
     * @return array
     */
    public function asFilter()
    {
        return [
            'email' => [FilterOperators::EQUAL => $this->email]
        ];
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $this->email === $user->email &&
            password_verify($this->password, $this->hash);
    }
    #endregion
}