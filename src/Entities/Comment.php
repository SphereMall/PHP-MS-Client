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
 *
 * @package SphereMall\MS\Entities
 *
 * @property int    $id
 * @property int    $parentId
 * @property string $userName
 * @property string $userEmail
 * @property int    $channelId
 * @property string $title
 * @property string $message
 * @property float  $rating
 * @property int    $entityId
 * @property int    $objectId
 * @property int    $visible
 * @property string $createDate
 * @property string $lastUpdate
 * @property string $userUidHash
 *
 * @property EntitiesAverageRating[] $entitiesAverageRating
 */
class Comment extends Entity
{
    #region [Properties]
    public $id;
    public $parentId;
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
    public $userUidHash;

    public $entitiesAverageRating;
    #endregion
}