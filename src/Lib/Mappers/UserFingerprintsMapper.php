<?php

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\UserFingerprints;

/**
 * Class UserFingerprintsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class UserFingerprintsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return UserFingerprints
     */
    protected function doCreateObject(array $array)
    {
        return new UserFingerprints($array);
    }
    #endregion
}
