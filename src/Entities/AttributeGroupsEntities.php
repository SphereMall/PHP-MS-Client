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
 * Class AttributeGroupsEntities
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $entityId
 * @property int $attributeGroupsId
 * @property int $attributeId
 */
class AttributeGroupsEntities extends Entity
{
    #region [Properties]
    public $id;
    public $entityId;
    public $attributeGroupsId;
    public $attributeId;
    #endregion
}