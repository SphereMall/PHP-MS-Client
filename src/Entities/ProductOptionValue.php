<?php

namespace SphereMall\MS\Entities;

/**
 * Class ProductOptionValue
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $optionId
 * @property int $optionValueId
 * @property int $relationProductId
 * @property string $title
 * @property string $price
 * @property int $amount
 * @property string $totalPrice
 * @property int $vatId
 * @property int $objectId
 */
class ProductOptionValue extends Entity
{
    #region [Properties]
    public $id;
    public $optionId;
    public $optionValueId;
    public $relationProductId;
    public $title;
    public $image;
    public $price;
    public $amount;
    public $totalPrice;
    public $vatId;
    public $objectId;
    #endregion
}