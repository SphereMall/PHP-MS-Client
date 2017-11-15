<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class User
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property int $active
 * @property string $guid
 * @property string $avatar
 * @property int $defaultAddressId
 * @property int $langId
 * @property int $basketId
 */
class User extends Entity
{
    #region [Properties]
    public $id;
    public $email;
    public $password;
    public $name;
    public $surname;
    public $active;
    public $guid;
    public $avatar;

    public $defaultAddressId;
    public $langId;
    public $basketId;
    #endregion
}