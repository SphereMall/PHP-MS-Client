<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 18:37
 */

namespace SphereMall\MS\Lib;

use SphereMall\MS\Client;
use SphereMall\MS\Lib\Basket\Basket;
use SphereMall\MS\Resources\AttributesResource;
use SphereMall\MS\Resources\AttributeValuesResource;
use SphereMall\MS\Resources\BasketResource;
use SphereMall\MS\Resources\BrandsResource;
use SphereMall\MS\Resources\DeliveryProvidersResource;
use SphereMall\MS\Resources\FunctionalNamesResource;
use SphereMall\MS\Resources\ImagesResource;
use SphereMall\MS\Resources\ProductAttributeValuesResource;
use SphereMall\MS\Resources\ProductsResource;

/**
 * Trait ServiceInjector
 * @package SphereMall\MS\Lib
 * @static Basket $basket
 */
trait ServiceInjector
{
    #region [Properties]
    protected static $basket = null;
    #endregion

    #region [Products service]
    /**
     * @return ProductsResource
     */
    public function products()
    {
        /** @var Client $this */
        return new ProductsResource($this);
    }

    /**
     * @return AttributesResource
     */
    public function attributes()
    {
        /** @var Client $this */
        return new AttributesResource($this);
    }

    /**
     * @return AttributeValuesResource
     */
    public function attributeValues()
    {
        /** @var Client $this */
        return new AttributeValuesResource($this);
    }

    /**
     * @return BrandsResource
     */
    public function brands()
    {
        /** @var Client $this */
        return new BrandsResource($this);
    }

    /**
     * @return FunctionalNamesResource
     */
    public function functionalNames()
    {
        /** @var Client $this */
        return new FunctionalNamesResource($this);
    }

    /**
     * @return ImagesResource
     */
    public function images()
    {
        /** @var Client $this */
        return new ImagesResource($this);
    }

    /**
     * @return ProductAttributeValuesResource
     */
    public function productAttributeValues()
    {
        /** @var Client $this */
        return new ProductAttributeValuesResource($this);
    }
    #endregion

    #region [Shop service]
    /**
     * @return BasketResource
     */
    public function basketResource()
    {
        /** @var Client $this */
        $client = clone $this;
        $client->setVersion('v2');

        return new BasketResource($client);
    }

    /**
     * @param int|null $id
     * @return Basket
     */
    public function basket(int $id = null)
    {
        if (is_null(static::$basket)) {
            /** @var Client $this */
            static::$basket = new Basket($this, $id);
        }

        return static::$basket;
    }

    /**
     * @return DeliveryProvidersResource
     */
    public function deliveryProviders()
    {
        /** @var Client $this */
        return new DeliveryProvidersResource($this);
    }
    #endregion
}