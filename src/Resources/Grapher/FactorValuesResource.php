<?php
/**
 * Created by SergeyBondarchuk.
 * 30.03.2018 12:29
 */

namespace SphereMall\MS\Resources\Grapher;


use SphereMall\MS\Resources\Resource;

/**
 * Class FactorValuesResource
 * @package SphereMall\MS\Resources\Grapher
 */
class FactorValuesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "factors";
    }
    #endregion
}