<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 31.08.2018
 * Time: 16:27
 */

namespace SphereMall\MS\Entities;

/**
 * Class Comment
 * @package SphereMall\MS\Entities
 */
class Comment extends Entity
{
    public $id;
    public $parentId;
    public $userId;
    public $userName;
    public $userEmail;
    public $channelId;
    public $title;
    public $message;
    public $rating;
    public $entityId;
    public $objectId;
    public $visible;
    public $createDate;
    public $lastUpdate;
}