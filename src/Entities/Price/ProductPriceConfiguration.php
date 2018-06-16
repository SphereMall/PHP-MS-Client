<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/13/2018
 * Time: 1:12 PM
 */

namespace SphereMall\MS\Entities\Price;

use SphereMall\MS\Entities\Entity;

/**
 * Class ProductPriceConfiguration
 * @package SphereMall\MS\Entities\Price
 */
class ProductPriceConfiguration extends Entity
{
    #region [Properties]
    public $id;
    public $productId;

    /**
     * @deprecated
     */
    public $affectedAttributes;
    /**
     * @deprecated
     */
    public $priceTable;

    public $priceWithVat;
    public $priceWithoutVat;

    #endregion
}