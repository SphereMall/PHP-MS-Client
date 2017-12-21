<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/18/2017
 * Time: 2:52 PM
 */

namespace SphereMall\MS\Tests\Lib\Entities;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class EntityTest extends SetUpResourceTest
{
    public function testCreateObject()
    {
        $entity = new Entity();
        $this->assertInstanceOf(Entity::class, $entity);
    }

    public function testGetEntityType()
    {
        $product = new Product();

        $this->assertEquals('product', $product->getType());
        $this->assertInstanceOf(Product::class, $product);

        $attribute = new Attribute();

        $this->assertEquals('attribute', $attribute->getType());
        $this->assertInstanceOf(Attribute::class, $attribute);
    }
}