<?php
/**
 * Created by SergeyBondarchuk.
 * 29.03.2018 18:52
 */

namespace SphereMall\MS\Resources\Grapher;

use SphereMall\MS\Resources\Resource;

/**
 * Class FactorsResource
 * @package SphereMall\MS\Resources\Grapher
 */
class FactorValuesResource extends Resource
{
    #region [Override methods]
    public function getURI()
    {
        return "factorvalues";
    }
    #endregion
}