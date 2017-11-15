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
 * Class AttributeType
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $code
 * @property int $visible
 * @property string $lastUpdate
 */
class AttributeType extends Entity
{
    #region [Properties]
    public $id;
    public $code;
    public $visible;
    public $lastUpdate;
    #endregion
}