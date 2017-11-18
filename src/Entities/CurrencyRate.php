<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class CurrencyRate
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $fromId
 * @property int $toId
 * @property float $rate
 * @property string $lastUpdate
 */
class CurrencyRate extends Entity
{
    #region [Properties]
    public $id;
    public $fromId;
    public $toId;
    public $rate;
    public $lastUpdate;
    #endregion
}