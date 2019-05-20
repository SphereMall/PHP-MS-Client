<?php

namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Entities\UserFingerprints;
use SphereMall\MS\Resources\Resource;

/**
 * Class UserFingerprintsResource
 *
 * @package SphereMall\MS\Resources\Grapher
 *
 * @method UserFingerprints get(int $id)
 * @method UserFingerprints first()
 * @method UserFingerprints[] all()
 * @method UserFingerprints update($id, $data)
 * @method UserFingerprints create($data)
 */
class UserFingerprintsResource extends Resource
{
    public function getURI()
    {
        return 'userfingerprints';
    }
}
