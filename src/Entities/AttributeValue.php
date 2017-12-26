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
 * Class AttributeValue
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $value
 * @property string $title
 * @property string $cssClass
 * @property string $image
 * @property int $orderNumber
 */
class AttributeValue extends Entity
{
    #region [Properties]
    public $id;
    public $value;
    public $title;
    public $cssClass;
    public $image;
    public $orderNumber;
    #endregion
}