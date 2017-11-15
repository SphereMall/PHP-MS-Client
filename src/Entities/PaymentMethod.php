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
 * Class PaymentMethod
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $icon
 * @property int $active
 */
class PaymentMethod extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $code;
    public $icon;
    public $active;
    #endregion
}