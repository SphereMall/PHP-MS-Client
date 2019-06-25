<?php

namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Entities\UserFingerPrints;
use SphereMall\MS\Resources\Resource;

/**
 * Class UserFingerprintsResource
 *
 * @package SphereMall\MS\Resources\Grapher
 *
 * @method UserFingerPrints get(int $id)
 * @method UserFingerPrints first()
 * @method UserFingerPrints[] all()
 * @method UserFingerPrints update($id, $data)
 * @method UserFingerPrints create($data)
 */
class UserFingerprintsResource extends Resource
{
    public function getURI()
    {
        return 'userfingerprints';
    }
}
