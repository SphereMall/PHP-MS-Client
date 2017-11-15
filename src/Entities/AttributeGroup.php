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
 * Class AttributeGroup
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property int $visible
 * @property int $orderNumber
 * @property string $lastUpdate
 */
class AttributeGroup extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $visible;
    public $orderNumber;
    public $lastUpdate;
    #endregion
}