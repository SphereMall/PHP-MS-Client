<?php
namespace SphereMall\MS\Resources\Grapher;


use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\MethodNotFoundException;
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
        return "factorvalues";
    }
    #endregion
}