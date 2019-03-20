<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:30
 */

namespace SphereMall\MS\Entities;


use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

/**
 * Class Action
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property string $name
 * @property string $properties
 * @property int    $actionTypeId
 */
class Action extends Entity
{
    use InteractsWithAttributes;

    public $id;
    public $name;
    public $properties;
    public $actionTypeId;
}
