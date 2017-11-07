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
 * Class Address
 * @package SphereMall\MS\Entities
 * @property int $id
 */
class Address extends Entity
{
    #region [Properties]
    public $id;
    public $userId;
    public $name;
    public $surname;
    public $email;
    public $countryName;
    public $cityName;
    public $street;
    public $zipCode;
    public $phoneNumber;
    public $companyName;
    public $clientNumber;
    public $state;
    #endregion
}