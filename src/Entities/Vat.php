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
 * Class Vat
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property float $percent
 * @property int $exclude
 */
class Vat extends Entity
{
    #region [Properties]
    public $id;
    public $percent;
    public $exclude;
    #endregion
}