<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

class Attribute extends Entity
{
    #region [Properties]
    public $id;
    public $code;
    public $title;
    public $showInSpecList;
    public $description;
    public $attributeGroupId;
    public $cssClass;
    #endregion
}