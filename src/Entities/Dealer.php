<?php
/**
 * Created by PhpStorm.
 * User: "Dmitriy Vorobey"
 * Date: 27.04.2018
 * Time: 12:45
 */

namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

/**
 * Class Dealer
 * @package SphereMall\MS\Entities
 * @property Attribute[] $attributes
 */
class Dealer extends Entity
{
    use InteractsWithAttributes;

    #region [Properties]
    public $id;
    public $name;
    public $clientNumber;
    public $visible;

    public $brand;
    public $addresses;
    public $attributes;
    #endregion
}
