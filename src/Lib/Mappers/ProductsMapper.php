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
 *
 * @package SphereMall\MS\Lib\Mappers
 *
 * @property Product $product
 * @property array   $data
 */
class ProductsMapper extends Mapper
{
    private $product;
    private $data;
    #region [Protected methods]

    /**
     * @param array $array
     *
     * @return Product
     */
    protected function doCreateObject(array $array)
    {
        $this->data    = $array;
        $this->product = new Product($this->data);
        $this->setBrands()
             ->setFunctionalNames()
             ->setPromotions()
             ->setProductsToPromotions()
             ->setOptions()
             ->setAttributes()
             ->setMedia();

        return $this->product;
    }

    #endregion

    #region [Private methods]
    /**
     * @return $this
     */
    private function setBrands()
    {
        if (isset($this->data['brands']) && $brand = reset($this->data['brands'])) {
            $this->product->brand = (new BrandsMapper)->createObject($brand);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setFunctionalNames()
    {
        if (isset($this->data['functionalNames']) && $functionalName = reset($this->data['functionalNames'])) {
            $this->product->functionalName = (new FunctionalNamesMapper)->createObject($functionalName);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setPromotions()
    {
        if (isset($this->data['promotions']) && is_array($this->data['promotions'])) {
            $mapper     = new PromotionsMapper();
            $promotions = [];
            foreach ($this->data['promotions'] as $promotion) {
                $promotions[] = $mapper->createObject($promotion);
            }
            $this->product->promotions = $promotions;
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setProductsToPromotions()
    {
        if (isset($this->data['productsToPromotions']) && is_array($this->data['productsToPromotions'])) {
            $mapper               = new ProductsToPromotionsMapper();
            $productsToPromotions = [];
            foreach ($this->data['productsToPromotions'] as $productsToPromotion) {
                $productsToPromotions[] = $mapper->createObject($productsToPromotion);
            }
            $this->product->productsToPromotions = $productsToPromotions;
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setOptions()
    {
        if (!isset($this->data['options']) || !is_array($this->data['options'])) {
            return $this;
        }

        $optionMapper              = new OptionsMapper();
        $productOptionValuesMapper = new ProductOptionValuesMapper();
        $options                   = [];
        foreach ($this->data['options'] as $option) {
            $option = $option['attributes'] ?? $option;

            $productOptionValues = array_filter($this->data['productOptionValues'] ?? [], function ($productOptionValue) use ($option) {
                $optionId = $productOptionValue['optionId'] ?? $productOptionValue['attributes']['optionId'];
                return $option['id'] == $optionId;
            });

            foreach ($productOptionValues ?? [] as $productOptionValue) {
                $option['values'][] = $productOptionValuesMapper->createObject($productOptionValue);
            }
            $options[] = $optionMapper->createObject($option);
        }
        $this->product->options = $options;

        return $this;
    }

    /**
     * @return $this
     */
    private function setAttributes()
    {
        if (!isset($this->data['attributes']) && isset($this->data['productAttributeValues'])) { // old structure
            $this->product->attributes = (new ProductAttributeValuesMapper)->createObject($this->data['productAttributeValues'] ?? []);
        } else {
            $attributes = [];
            foreach ($this->data['entityAttributeValues'] ?? [] as $av) {
                $attributeId = $av['attributes']['attributeId'] ?? $av['attributeId'];
                if (!isset($attributes[$attributeId])) {
                    $attribute = $av['attributes'][0] ?? $av['relationships']['attributes'][0] ?? $this->data['attributes'][$attributeId];
                    $attributes[$attributeId] = new Attribute($attribute);
                }
                $attributeValue = isset($av['attributeValues'][0]) && is_array($av['attributeValues'][0]) ? $av['attributeValues'][0] : $av;
                $attributes[$attributeId]->values[$av['id']] = new AttributeValue($attributeValue);
            }

            $this->product->attributes = $attributes;
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setMedia()
    {
        $result = [];
        if (isset($this->data['mediaEntities'])) {
            foreach ($this->data['mediaEntities'] ?? [] as $mediaEntity) {

                if (isset($mediaEntity['media'][0])) {

                    $media = new Media($mediaEntity['media'][0]);
                    if (!$this->product->mainMedia) {
                        $this->product->mainMedia = $media;
                    }
                    $result[$mediaEntity['id']] = $media;
                }
            }

            $this->product->media = $result;

            return $this;

        }

        if (isset($this->data['media'])) {  // old structure
            $mapper = new ImagesMapper();
            foreach ($this->data['media'] as $image) {
                $result[] = $mapper->createObject($image);
            }
            if (!empty($this->product->media[0])) {
                $this->product->mainMedia = $result[0];
            }
        }

        $this->product->media = $result;

        return $this;
    }
    #endregion
}
