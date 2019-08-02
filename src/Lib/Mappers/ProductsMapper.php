<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Media;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Lib\Mappers\Traits\AttributesSetter;


/**
 * Class ProductsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 *
 * @property Product $entity
 * @property array $data
 */
class ProductsMapper extends Mapper
{
    use AttributesSetter;

    private $entity;
    private $data;
    #region [Protected methods]

    /**
     * @param array $array
     *
     * @return Product
     */
    protected function doCreateObject(array $array)
    {
        $this->data = $array;
        $this->entity = new Product($this->data);
        $this->setBrands()
            ->setFunctionalNames()
            ->setPromotions()
            ->setProductsToPromotions()
            ->setOptions()
            ->setAttributes()
            ->setMedia();

        return $this->entity;
    }

    #endregion

    #region [Private methods]
    /**
     * @return $this
     */
    private function setBrands()
    {
        if (isset($this->data['brands']) && $brand = reset($this->data['brands'])) {
            $this->entity->brand = (new BrandsMapper)->createObject($brand);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setFunctionalNames()
    {
        if (isset($this->data['functionalNames']) && $functionalName = reset($this->data['functionalNames'])) {
            $this->entity->functionalName = (new FunctionalNamesMapper)->createObject($functionalName);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setPromotions()
    {
        if (isset($this->data['promotions']) && is_array($this->data['promotions'])) {
            $mapper = new PromotionsMapper();
            $promotions = [];
            foreach ($this->data['promotions'] as $promotion) {
                $promotions[] = $mapper->createObject($promotion);
            }
            $this->entity->promotions = $promotions;
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setProductsToPromotions()
    {
        if (isset($this->data['productsToPromotions']) && is_array($this->data['productsToPromotions'])) {
            $mapper = new ProductsToPromotionsMapper();
            $productsToPromotions = [];
            foreach ($this->data['productsToPromotions'] as $productsToPromotion) {
                $productsToPromotions[] = $mapper->createObject($productsToPromotion);
            }
            $this->entity->productsToPromotions = $productsToPromotions;
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

        $optionMapper = new OptionsMapper();
        $productOptionValuesMapper = new ProductOptionValuesMapper();
        $options = [];
        foreach ($this->data['options'] as $option) {
            $option = $option['attributes'] ?? $option;

            $productOptionValues = array_filter($this->data['productOptionValues'] ?? [],
                function ($productOptionValue) use ($option) {
                    $optionId = $productOptionValue['optionId'] ?? $productOptionValue['attributes']['optionId'];
                    return $option['id'] == $optionId;
                });

            foreach ($productOptionValues ?? [] as $productOptionValue) {
                $option['values'][] = $productOptionValuesMapper->createObject($productOptionValue);
            }
            $options[] = $optionMapper->createObject($option);
        }
        $this->entity->options = $options;

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

                if (isset($mediaEntity['media'][0]) || isset($mediaEntity['relationships']['media'][0])) {

                    $media = new Media($mediaEntity['media'][0] ?? $mediaEntity['relationships']['media'][0]);

                    if (!$this->entity->mainMedia) {
                        $this->entity->mainMedia = $media;
                    }
                    $result[$mediaEntity['id']] = $media;
                }
            }

            $this->entity->media = $result;

            return $this;

        }

        if (isset($this->data['media'])) {  // old structure
            $mapper = new ImagesMapper();
            foreach ($this->data['media'] as $image) {
                $result[] = $mapper->createObject($image);
            }
            if (!empty($this->entity->media[0])) {
                $this->entity->mainMedia = $result[0];
            }
        }

        $this->entity->media = $result;

        return $this;
    }
    #endregion
}
