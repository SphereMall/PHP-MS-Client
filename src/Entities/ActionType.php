<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:35
 */

namespace SphereMall\MS\Entities;


use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

/**
 * Class ActionType
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property string $name
 * @property string $class
 */
class ActionType extends Entity
{
    use InteractsWithAttributes;

    public $id;
    public $name;
    public $class;
}
