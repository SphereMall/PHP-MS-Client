<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class EventActionCampaign
 *
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $eventId
 * @property int $actionId
 * @property int $campaignId
 */
class EventActionCampaign extends Entity
{
    public $id;
    public $eventId;
    public $actionId;
    public $campaignId;
}
