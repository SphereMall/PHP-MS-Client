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
    protected $id;
    protected $code;
    protected $title;
    protected $showInSpecList;
    protected $description;
    protected $attributeGroupId;
    protected $cssClass;
    #endregion
}