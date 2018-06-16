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
    public $attributes;
    public $options;
    #endregion

    #region [Constructor]
    public function __construct(int $productId, int $priceTypeId, $attributes, $options)
    {
        $this->productId   = $productId;
        $this->priceTypeId = $priceTypeId;
        $this->attributes  = $attributes;
        $this->options     = $options;
    }
    #endregion
}
