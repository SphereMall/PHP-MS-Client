<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Product;

/**
 * Class ProductsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class ProductsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Product
     */
    protected function doCreateObject(array $array)
    {
        $product = new Product($array);

        if (isset($array['productAttributeValues'])) {
            $mapper              = new ProductAttributeValuesMapper();
            $product->attributes = $mapper->createObject($array['productAttributeValues']);
        }

        if (isset($array['images'])) {
            $mapper = new ImagesMapper();
            foreach ($array['images'] as $image) {
                $product->media[] = $mapper->createObject($image);
            }


            if (!empty($product->media[0])) {
                $product->mainMedia = $product->media[0];
            }
        }

        if (isset($array['brands'][0])) {
            $mapper         = new BrandsMapper();
            $product->brand = $mapper->createObject($array['brands'][0]);

        }

        if (isset($array['functionalNames'][0])) {
            $mapper                  = new FunctionalNamesMapper();
            $product->functionalName = $mapper->createObject($array['functionalNames'][0]);

        }

        return $product;
    }
    #endregion
}
