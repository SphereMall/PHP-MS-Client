<?php

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\UserFingerPrints;

/**
 * Class UserFingerprintsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 */
class UserFingerPrintsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return UserFingerPrints
     */
    protected function doCreateObject(array $array)
    {
        return new UserFingerPrints($array);
    }
    #endregion
}
