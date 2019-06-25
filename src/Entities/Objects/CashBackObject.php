<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.06.2019
 * Time: 15:38
 */

namespace SphereMall\MS\Entities\Objects;

use SphereMall\MS\Entities\Entity;

/**
 * Class CashBackObject
 * @package SphereMall\MS\Entities\Objects
 * @property int $id
 * @property string $title
 */
class CashBackObject extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    #endregion
}