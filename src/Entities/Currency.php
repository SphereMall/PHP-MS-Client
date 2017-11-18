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
 * Class Currency
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $symbol
 * @property int $active
 * @property int $default
 */
class Currency extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $code;
    public $symbol;
    public $active;
    public $default;
    #endregion
}