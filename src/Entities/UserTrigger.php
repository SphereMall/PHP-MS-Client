<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:36
 */

namespace SphereMall\MS\Entities;

/**
 * Class UserTrigger
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property int    $userId
 * @property int    $triggerId
 * @property string $executionTime
 */
class UserTrigger extends Entity
{
    public $id;
    public $userId;
    public $triggerId;
    public $executionTime;
}
