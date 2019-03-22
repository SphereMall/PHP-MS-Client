<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:35
 */

namespace SphereMall\MS\Entities;

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
    public $id;
    public $name;
    public $class;
}
