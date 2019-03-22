<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:36
 */

namespace SphereMall\MS\Entities;

/**
 * Class UserTriggerHistory
 *
 * @package SphereMall\MS\Entities
 * @property int  $id
 * @property int  $eventId
 * @property int  $campaignId
 * @property int  $nextTriggerId
 * @property int  $userId
 * @property bool $isLast
 */
class UserTriggerHistory extends Entity
{
    public $id;
    public $eventId;
    public $campaignId;
    public $nextTriggerId;
    public $userId;
    public $isLast;
}
