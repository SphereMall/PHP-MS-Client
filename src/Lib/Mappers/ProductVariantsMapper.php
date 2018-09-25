<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Entities\Media;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Entities\ProductOptionValue;
use SphereMall\MS\Entities\ProductVariant;

/**
 * Class ProductsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductVariantsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return ProductVariant
     */
    protected function doCreateObject(array $array)
    {
        return new ProductVariant($array);
    }
    #endregion
}
