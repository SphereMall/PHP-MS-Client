<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 15:45
 */

namespace SphereMall\MS\Entities;

/**
 * Class Promotion
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $startDate
 * @property string $endDate
 * @property string $description
 * @property int $active
 * @property int $couponsTypeId
 * @property int $activateByCoupon
 * @property int $usageLimit
 * @property int $usagePerUser
 * @property int $objectId
 */
class Promotion extends Entity
{
    public $id;
    public $title;
    public $startDate;
    public $endDate;
    public $description;
    public $active;
    public $lastUpdate;
    public $couponsTypeId;
    public $activateByCoupon;
    public $usageLimit;
    public $usagePerUser;
    public $objectId;
}