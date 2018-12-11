<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 11.12.18
 * Time: 17:14
 */

namespace SphereMall\MS\Entities;


class ProductGroup extends Entity
{
    #region [Properties]
    public $id;
    public $urlCode;
    public $title;
    public $visible;
    public $orderNumber;
    public $lastUpdate;
    public $createDate;
    #endregion
}
