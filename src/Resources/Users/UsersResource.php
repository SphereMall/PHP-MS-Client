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
use SphereMall\MS\Lib\Filters\FilterOperators;
use SphereMall\MS\Lib\Helpers\Guid;
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
     * @param $name
     * @return User|null
     */
    public function subscribe(string $email, string $name = '')
    {
        $userList = $this->filter(new IsUserEmail($email))
                         ->limit(1)
                         ->all();

        $user = $userList[0] ?? new User([
                'email'        => $email,
                'name'         => $name,
                'guid'         => Guid::Generate(),
                'isSubscriber' => 1
            ]);

        if ((new IsUserSubscriber())->isSatisfiedBy($user)) {
            return null;
        }

        if ($user->id) {
            return $this->update($user->id, ['isSubscriber' => 1]);

        }

        return $this->create($user);
    }

    /**
     * Unsubscribe user
     * @see $properties
     * @param $guid
     * @return User|null
     */
    public function unsubscribe(string $guid)
    {
        $userList = $this->fields(['isSubscriber'])
                         ->filter(['guid' => [FilterOperators::EQUAL => $guid]])
                         ->limit(1)
                         ->all();

        if (!isset($userList[0]) || !(new IsUserSubscriber())->isSatisfiedBy($userList[0])) {
            return null;
        }

        return $this->update($userList[0]->id, ['isSubscriber' => 0]);
    }
    #endregion
}