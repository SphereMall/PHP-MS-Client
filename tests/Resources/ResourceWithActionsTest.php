<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 16:47
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\Product;
use SphereMall\MS\Lib\Constants\OptionalEntities;

class ResourceWithActionsTest extends SetUpResourceTest
{
    public function testIncludeExcludeEntities(){
        $products = $this->client->products()
                                 ->limit(5)
                                 ->fullAll();

        foreach ($products as $product){
            $this->assertInstanceOf(Product::class, $product);
        }

        foreach ($products as $product) {
            if(empty($product->media)){
                $product = $this->client->products()
                                        ->includeEntities([OptionalEntities::PROMOTIONS])
                                        ->excludeEntities([OptionalEntities::MEDIA])
                                        ->fullByCode($product->urlCode);

                $this->assertEmpty($product->media);
            }
        }

    }
}