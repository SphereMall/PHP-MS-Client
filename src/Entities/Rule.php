<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 26.04.2018
 * Time: 10:00
 */

namespace SphereMall\MS\Entities;

class Rule extends Entity
{
    #region [Properties]
    public $promotionId;
    public $title;
    public $discountValue;
    public $discountTypeId;
    public $conditions;
    #endregion
}