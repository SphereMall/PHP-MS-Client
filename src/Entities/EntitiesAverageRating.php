<?php
/**
 * Created by PHPStorm.
 * User: Slavik
 * Date: 21-May-19
 * Time: 10:04
 */

namespace SphereMall\MS\Entities;


use SphereMall\MS\Lib\Constants\Entities;

/**
 * Class EntitiesAverageRating
 *
 * @package SphereMall\MS\Entities
 *
 * @property int    $id
 * @property int    $entityId
 * @property int    $objectId
 * @property float  $averageRating
 * @property string $lastUpdate
 */
class EntitiesAverageRating extends Entities
{
    #region [Properties]
    public $id;
    public $entityId;
    public $objectId;
    public $averageRating;
    public $lastUpdate;
    #endregion
}
