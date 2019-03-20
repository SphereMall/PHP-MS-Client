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
 * Class Trigger
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property string $name
 * @property int    $triggerTypeId
 * @property string $code
 * @property string $properties
 */
class Trigger extends Entity
{
    use InteractsWithAttributes;

    public $id;
    public $name;
    public $triggerTypeId;
    public $code;
    public $properties;

}
