<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:24 PM
 */

namespace SphereMall\MS\Lib\Specifications\Products;

use SphereMall\MS\Entities\Product;

/**
 * Interface ProductSpecification
 * @package SphereMall\MS\Lib\Specifications
 */
interface ProductSpecification
{
    /**
     * @param Product $product
     * @return bool
     */
    public function isSatisfiedBy(Product $product);
}