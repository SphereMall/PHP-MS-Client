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
 * Class Product
 * @package SphereMall\MS\Entities
 * @property int $productId
 * @property string $relationId
 */
class ProductVariant extends Entity
{
    #region [Properties]
    public $productId;
    public $relationId;
    public $orderNumber;
    #endregion
}