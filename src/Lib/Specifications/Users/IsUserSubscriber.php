<?php

namespace SphereMall\MS\Lib\Specifications\Users;

use SphereMall\MS\Entities\User;
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;

/**
 * Class IsUserSubscriber
 * @package SphereMall\MS\Lib\Specifications\Users
 */
class IsUserSubscriber implements FilterSpecification, UserSpecification
{
    #region [Implementations]
    /**
     * @return array
     */
    public function asFilter()
    {
        return ['isSubscriber' => [FilterOperators::EQUAL => 1]];
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return $user->id && $user->isSubscriber;
    }
    #endregion
}