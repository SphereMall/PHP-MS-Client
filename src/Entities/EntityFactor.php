<?php
/**
 * Created by Yurii Koida.
 * 11.04.2018 12:32
 */

namespace SphereMall\MS\Entities;

/**
 * Class EntityFactor
 * @package SphereMall\MS\Entities
 * @property string $code
 * @property string $name
 * @property Factor $factor
 * @property FactorValue $factorValue
 */
class EntityFactor extends Entity
{
    #region [Properties]
    public $code;
    public $value;
    public $factor;
    public $factorValue;
    #endregion
}