<?php
/**
 * Created by SergeyBondarchuk.
 * 29.03.2018 18:46
 */

namespace SphereMall\MS\Entities;

/**
 * Class Factor
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property int $displayType
 * @property string $lastUpdate
 * @property FactorValue[] $values
 */
class Factor extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $description;
    public $code;
    public $displayType;
    public $lastUpdate;
    public $values;
    #endregion
}