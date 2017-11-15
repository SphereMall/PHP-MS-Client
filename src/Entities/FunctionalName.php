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
 * Class FunctionalName
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $code
 * @property string $title
 */
class FunctionalName extends Entity
{
    #region [Properties]
    public $id;
    public $code;
    public $title;
    #endregion
}