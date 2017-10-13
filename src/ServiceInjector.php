<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 18:37
 */

namespace SphereMall\MS;

use SphereMall\MS\Entities\Products;
use SphereMall\MS\Resources\ProductsResource;

trait ServiceInjector
{
    /**
     * @return ProductsResource
     */
    public function products()
    {
        /** @var Client $this */
        return new ProductsResource($this, Products::class);
    }
}