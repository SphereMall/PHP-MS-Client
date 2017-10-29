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
 * Class OrderItem
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $orderId
 * @property Product $product
 */
class OrderItem extends Entity
{
    #region [Properties]
    public $id;
    public $orderId;
    public $amount;
    public $promotionId;
    public $compound;
    public $itemPrice;
    public $itemDiscountPrice;
    public $itemPriceWithDiscount;
    public $vatId;
    public $itemVatPrice;
    public $itemVatExcludedPrice;
    public $totalPrice;

    public $product;
    #endregion
}