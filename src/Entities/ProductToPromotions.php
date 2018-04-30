<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 15:39
 */

namespace SphereMall\MS\Entities;

/**
 * Class ProductToPromotions
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $productId
 * @property int $promotionId
 * @property int $ruleId
 * @property int $discountValue
 * @property string $title
 * @property string $discountTypeTitle
 * @property int $itemPrice
 * @property int $discountPrice
 */
class ProductToPromotions extends Entity
{
    public $id;
    public $productId;
    public $promotionId;
    public $ruleId;
    public $discountValue;
    public $title;
    public $discountTypeTitle;
    public $class;
    public $itemPrice;
    public $discountPrice;

}