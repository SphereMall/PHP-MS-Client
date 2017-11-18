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
 * Class OrderStatus
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $description
 */
class OrderStatus extends Entity
{
    #region [Properties]
    public $id;
    public $description;
    #endregion
}