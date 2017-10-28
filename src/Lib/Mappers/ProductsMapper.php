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
use SphereMall\MS\Lib\Collection;

class ProductsMapper extends Mapper
{
    #region [Protected methods]
    protected function doCreateObject(array $array)
    {
        $product = new Product($array);

        if (isset($array['productAttributeValues'])) {
            $mapper = new ProductAttributeValuesMapper();
            $attributes = $mapper->createObject($array['productAttributeValues']);
            $product->attributes = new Collection($attributes);
        }

        if (isset($array['images'])) {
            $mapper = new MediaMapper();
            $media = [];
            foreach ($array['images'] as $image) {
                $media[] = $mapper->createObject($image);
            }
            $product->media = new Collection($media);


            if ($product->media && $product->media->count()) {
                $product->mainMedia = $product->media->current();
            }
        }

        if (isset($array['brands'][0])) {
            $mapper = new BrandsMapper();
            $product->brand = $mapper->createObject($array['brands'][0]);

        }

        if (isset($array['functionalNames'][0])) {
            $mapper = new FunctionalNamesMapper();
            $product->functionalName = $mapper->createObject($array['functionalNames'][0]);

        }

        return $product;
    }
    #endregion
}