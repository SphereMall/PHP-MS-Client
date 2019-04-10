<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.04.2019
 * Time: 10:17
 */

namespace SphereMall\MS\Entities;

/**
 * Class History
 *
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property int    $objectTypeId
 * @property int    $entityId
 * @property int    $objectId
 * @property string $fieldName
 * @property string $oldValue
 * @property string $newValue
 * @property string $createDate
 * @property int    $userId
 * @property int    $userTypeId
 */
class History extends Entity
{
    public $id;
    public $objectTypeId;
    public $entityId;
    public $objectId;
    public $fieldName;
    public $oldValue;
    public $newValue;
    public $createDate;
    public $userId;
    public $userTypeId;
}
