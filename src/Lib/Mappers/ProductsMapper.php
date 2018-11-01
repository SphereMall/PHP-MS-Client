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

        if (isset($array['brands']) && $brand = reset($array['brands'])) {
            $mapper         = new BrandsMapper();
            $product->brand = $mapper->createObject($brand);
        }

        if (isset($array['functionalNames']) && $functionalName = reset($array['functionalNames'])) {
            $mapper                  = new FunctionalNamesMapper();
            $product->functionalName = $mapper->createObject($functionalName);
        }

        if (isset($array['promotions']) && is_array($array['promotions'])) {
            $mapper = new PromotionsMapper();
            $promotions = [];
            foreach ($array['promotions'] as $promotion) {
                $promotions[] = $mapper->createObject($promotion);
            }

            $product->promotions = $promotions;
        }

        if (isset($array['productsToPromotions']) && is_array($array['productsToPromotions'])) {
            $mapper = new ProductsToPromotionsMapper();
            $productsToPromotions = [];
            foreach ($array['productsToPromotions'] as $productsToPromotion) {
                $productsToPromotions[] = $mapper->createObject($productsToPromotion);
            }

            $product->productsToPromotions = $productsToPromotions;
        }

        if(isset($array['options']) && is_array($array['options'])){
            $optionMapper = new OptionsMapper();
            $productOptionValuesMapper = new ProductOptionValuesMapper();
            $options = [];

            foreach ($array['options'] as $option){
                $productOptionValues = array_filter($array['productOptionValues'] ?? [], function($productOptionValue) use ($option) {
                    return $option['id'] == $productOptionValue['optionId'];
                });

                foreach ($productOptionValues ?? [] as $productOptionValue){
                    $option['values'][] = $productOptionValuesMapper->createObject($productOptionValue);
                }

                $options[] = $optionMapper->createObject($option);
            }

            $product->options = $options;

        }

        /* Customize mapping */
        $product = isset($array['attributes'])
            ? $this->buildDetailResponse($product, $array)
            : $this->buildFullResponse($product, $array);

        return $product;
    }

    /**
     * map data with custom fields
     *
     * @param Product $product
     * @param array $array
     * @return Product
     */
    private function buildFullResponse(Product $product, array $array)
    {
        if (isset($array['productAttributeValues'])) {
            $mapper              = new ProductAttributeValuesMapper();
            $attributes = $mapper->createObject($array['productAttributeValues']);
            $product->setAttributes($attributes);
        }

        if (isset($array['media'])) {
            $media = [];
            $mapper = new ImagesMapper();
            foreach ($array['media'] as $image) {
                $media[] = $mapper->createObject($image);
            }

            $product->media = $media;

            if (!empty($product->media[0])) {
                $product->mainMedia = $product->media[0];
            }
        }

        return $product;
    }

    /**
     * map data without custom fields
     *
     * @param Product $product
     * @param array $array
     * @return Product
     */
    private function buildDetailResponse(Product $product, array $array)
    {
        $avs = $array['attributeValues'] ?? [];
        $as = $array['attributes'] ?? [];

        /** @var Attribute[] $attributes */
        $attributes = [];

        foreach ($avs as $av) {
            if (!isset($attributes[$av['attributeId']])) {
                $attributes[$av['attributeId']] = new Attribute($as[$av['attributeId']]);
            }
            $attributes[$av['attributeId']]->values[$av['id']] = new AttributeValue($av);
        }

        $product->setAttributes($attributes);

        $me = $array['mediaEntities'] ?? [];
        $m = $array['media'] ?? [];

        /** @var Media[] $media */
        $media = [];

        foreach ($me as $item) {
            $media[$item['id']] = new Media(array_merge($m[$item['mediaId']], $item));
        }

        $product->media = $media;

        if (!empty($product->media[0])) {
            $product->mainMedia = $product->media[0];
        }

        return $product;
    }
    #endregion
}
