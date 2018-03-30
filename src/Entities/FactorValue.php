<?php
/**
 * Created by SergeyBondarchuk.
 * 29.03.2018 18:50
 */

namespace SphereMall\MS\Entities;

/**
 * Class FactorValue
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $value
 * @property int $factorId
 * @property string $image
 * @property int $orderNumber
 * @property int $active
 * @property string $lastUpdate
 */
class FactorValue extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $description;
    public $value;
    public $factorId;
    public $image;
    public $orderNumber;
    public $active;
    public $lastUpdate;
    #endregion
}