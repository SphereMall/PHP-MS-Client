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
 * Class Option
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property int $visible
 * @property string $description
 * @property int $orderNumber
 */
class Option extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $visible;
    public $description;
    public $orderNumber;

    public $values;
    #endregion
}