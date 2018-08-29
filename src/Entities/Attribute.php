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
 * Class Attribute
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $code
 * @property string $title
 * @property int $displayType
 * @property int $showInSpecList
 * @property int $useInFilter
 * @property string $description
 * @property int $attributeGroupId
 * @property string $cssClass
 * @property int $orderNumber
 * @property string $schemaOrgProperty
 * @property AttributeValue[] $values
 * @property AttributeGroup $group
 */
class Attribute extends Entity
{
    #region [Properties]
    public $id;
    public $code;
    public $title;
    public $displayType;
    public $showInSpecList;
    public $useInFilter;
    public $description;
    public $attributeGroupId;
    public $cssClass;
    public $orderNumber;
    public $schemaOrgProperty;

    public $values;
    public $group;
    #endregion
}
