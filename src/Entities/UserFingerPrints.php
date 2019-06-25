<?php

namespace SphereMall\MS\Entities;

/**
 * Class UserFingerprints
 *
 * @package SphereMall\MS\Entities
 *
 * @property int    $id
 * @property int    $userId
 * @property string $fingerprint
 * @property string $userUidHash
 * @property string $createDate
 */
class UserFingerPrints extends Entity
{
    #region [Properties]
    public $id;
    public $userId;
    public $fingerprint;
    public $userUidHash;
    public $createDate;
    #endregion
}
