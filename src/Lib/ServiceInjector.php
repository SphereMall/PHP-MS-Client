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
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Lib\Basket\Basket;
use SphereMall\MS\Resources\AddressResource;
use SphereMall\MS\Resources\AttributesResource;
use SphereMall\MS\Resources\AttributeValuesResource;
use SphereMall\MS\Resources\BasketResource;
use SphereMall\MS\Resources\BrandsResource;
use SphereMall\MS\Resources\DeliveryPaymentsResource;
use SphereMall\MS\Resources\DeliveryProvidersResource;
use SphereMall\MS\Resources\FunctionalNamesResource;
use SphereMall\MS\Resources\ImagesResource;
use SphereMall\MS\Resources\OrdersResource;
use SphereMall\MS\Resources\PaymentMethodsResource;
use SphereMall\MS\Resources\ProductAttributeValuesResource;
use SphereMall\MS\Resources\ProductsResource;
use SphereMall\MS\Resources\UsersResource;

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
     * @return OrdersResource
     */
    public function orders()
    {
        /** @var Client $this */
        return new OrdersResource($this);
    }

    /**
     * @return BasketResource
     */
    public function basketResource()
    {
        /** @var Client $this */
        return new BasketResource($this, "v2");
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

    /**
     * @return PaymentMethodsResource
     */
    public function paymentMethods()
    {
        /** @var Client $this */
        return new PaymentMethodsResource($this);
    }

    /**
     * @return DeliveryPaymentsResource
     */
    public function deliveryPayments()
    {
        /** @var Client $this */
        return new DeliveryPaymentsResource($this);
    }
    #endregion

    #region [Users service]
    /**
     * @return AddressResource
     */
    public function addresses()
    {
        /** @var Client $this */
        return new AddressResource($this);
    }

    /**
     * @return UsersResource
     */
    public function users()
    {
        /** @var Client $this */
        return new UsersResource($this);
    }
    #endregion
}