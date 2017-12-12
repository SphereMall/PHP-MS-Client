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
 * @property int $amount
 * @property int $promotionId
 * @property string $compound
 * @property int $itemPrice
 * @property int $itemDiscountPrice
 * @property int $itemPriceWithDiscount
 * @property int $vatId
 * @property int $itemVatPrice
 * @property int $itemVatExcludePrice
 * @property int $totalPrice
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
    public $itemVatExcludePrice;
    public $totalPrice;

    public $product;
    #endregion
}