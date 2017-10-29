<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */
namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Collection;

/**
 * Class Order
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property Collection $items
 */
class Order extends Entity
{
    #region [Properties]
    public $id;
    public $items = [];
    #endregion
}