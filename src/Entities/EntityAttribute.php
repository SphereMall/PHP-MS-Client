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
 * Class EntityAttribute
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $entityId
 * @property int $objectId
 * @property int $attributeId
 * @property int $attributeValueId
 * @property string $lastUpdate
 */
class EntityAttribute extends Entity
{
    #region [Properties]
    public $id;
    public $entityId;
    public $objectId;
    public $attributeId;
    public $attributeValueId;
    public $lastUpdate;
    #endregion
}