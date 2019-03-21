<?php

namespace SphereMall\MS\Entities;

/**
 * Class ConsumerFactor
 *
 * @package SphereMall\MS\Entities
 *
 * @property int       $id
 * @property int       $userId
 * @property \stdClass $factors
 * @property \stdClass $context
 */
class ConsumerFactorHistory extends Entity
{
    #region [Properties]
    public $id;
    public $userId;
    public $factors;
    public $context;
    #endregion
}
