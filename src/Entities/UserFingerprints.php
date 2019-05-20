<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

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
class UserFingerprints extends Entity
{
    #region [Properties]
    public $id;
    public $userId;
    public $fingerprint;
    public $userUidHash;
    public $createDate;
    #endregion
}
