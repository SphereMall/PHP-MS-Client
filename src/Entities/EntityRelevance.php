<?php

namespace SphereMall\MS\Entities;

/**
 * Class EntityRelevance
 *
 * @package SphereMall\MS\Entities
 *
 * @property int    $id
 * @property string $userUidHash
 * @property int    $entityId
 * @property int    $objectId
 * @property float  $value
 */
class EntityRelevance extends Entity
{
    #region [Properties]
    public $id;
    public $userUidHash;
    public $entityId;
    public $objectId;
    public $value;
    #endregion
}
