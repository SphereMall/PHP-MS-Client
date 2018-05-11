<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 12:45
 */

namespace SphereMall\MS\Entities;

/**
 * Class Dealer
 * @package SphereMall\MS\Entities
 */
class Dealer extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $clientNumber;
    public $visible;

    public $brand;
    public $addresses;
    #endregion
}
