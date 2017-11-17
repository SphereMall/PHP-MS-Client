<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Users;

use SphereMall\MS\Entities\User;
use SphereMall\MS\Lib\Specifications\Users\IsUserEmail;
use SphereMall\MS\Lib\Specifications\Users\IsUserSubscriber;
use SphereMall\MS\Resources\Resource;

/**
 * Class UsersResource
 * @package SphereMall\MS\Resources\Users
 * @method User get(int $id)
 * @method User[] all()
 * @method User update($id, $data)
 * @method User create($data)
 */
class UsersResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "users";
    }

    /**
     * Subscribe user
     * @see $properties
     * @param $email
     * @return bool
     */
    public function subscribe(string $email)
    {
        $userList = $this->filter(new IsUserEmail($email))
                         ->limit(1)
                         ->all();

        $user = $userList[0] ?? new User(['email' => $email, 'isSubscriber' => 1]);

        if ((new IsUserSubscriber())->isSatisfiedBy($user)) {
            return false;
        }

        if ($user->id) {
            $this->update($user->id, ['isSubscriber' => 1]);

            return true;
        }

        $this->create($user);

        return true;
    }
    #endregion
}