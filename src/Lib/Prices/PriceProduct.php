<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/13/2018
 * Time: 1:01 PM
 */

namespace SphereMall\MS\Lib\Prices;

/**
 * Class PriceProduct
 * @package SphereMall\MS\Lib\Prices
 */
class PriceProduct
{
    #region [Properties]
    public $productId;
    public $priceTypeId;
    #endregion

    #region [Constructor]
    public function __construct(int $productId, int $priceTypeId)
    {
        $this->productId = $productId;
        $this->priceTypeId = $priceTypeId;
    }
    #endregion
}