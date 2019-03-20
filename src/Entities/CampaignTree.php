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
 * Class CampaignTree
 *
 * @package SphereMall\MS\Entities
 * @property int $campaignId
 * @property int $eventId
 * @property int $triggerId
 * @property int $orderNumber
 */
class CampaignTree extends Entity
{
    use InteractsWithAttributes;

    public $campaignId;
    public $eventId;
    public $triggerId;
    public $orderNumber;
}
