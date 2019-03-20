<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 15:37
 */

namespace SphereMall\MS\Entities;


use SphereMall\MS\Lib\Traits\InteractsWithAttributes;

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
    use InteractsWithAttributes;

    public $id;
    public $eventId;
    public $actionId;
    public $campaignId;
}
