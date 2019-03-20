<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:36
 */

namespace SphereMall\MS\Entities;


use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

/**
 * Class TriggerType
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property string $name
 */
class TriggerType extends Entity
{
    use InteractsWithAttributes;

    public $id;
    public $name;
}
