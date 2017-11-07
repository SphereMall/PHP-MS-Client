<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

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