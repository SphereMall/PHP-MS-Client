<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

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