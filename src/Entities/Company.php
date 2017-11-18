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
 * Class Company
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $companyName
 * @property string $city
 * @property string $zipCode
 * @property string $country
 * @property string $street
 * @property string $houseNumber
 * @property string $kvkNumber
 */
class Company extends Entity
{
    #region [Properties]
    public $id;
    public $companyName;
    public $city;
    public $zipCode;
    public $country;
    public $street;
    public $houseNumber;
    public $kvkNumber;
    #endregion
}