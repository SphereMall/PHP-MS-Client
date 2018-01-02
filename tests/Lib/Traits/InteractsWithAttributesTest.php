<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/22/2017
 * Time: 2:34 PM
 */

namespace SphereMall\MS\Tests\Lib\Traits;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\Product;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class InteractsWithAttributesTest extends SetUpResourceTest
{
    /**
     * @test
     */
    public function get_attribute_by_code()
    {
        $product = $this->getMockedProduct();
        $this->assertEquals('second', $product->getAttributeByCode('second')->code);
    }

    /**
     * @test
     */
    public function get_attribute_by_id()
    {
        $product = $this->getMockedProduct();
        $this->assertEquals(3, $product->getAttributeById(3)->id);
    }

    /**
     * @test
     */
    public function get_attribute_by_ids()
    {
        $product = $this->getMockedProduct();
        $this->assertEquals([
            new Attribute([
                'id'   => 1,
                'code' => 'first',
            ]),
            new Attribute([
                'id'   => 2,
                'code' => 'second',
            ]),

        ], $product->getAttributesByIds([2, 1]));
    }

    /**
     * @test
     */
    public function get_attribute_by_codes()
    {
        $product = $this->getMockedProduct();
        $this->assertEquals([
            new Attribute([
                'id'   => 1,
                'code' => 'first',
            ]),
            new Attribute([
                'id'   => 2,
                'code' => 'second',
            ]),

        ], $product->getAttributesByCodes(['first', 'second']));
    }

    protected function getMockedProduct()
    {
        $product = new Product([
            'id' => 1,
        ]);

        $first = new Attribute([
            'id'   => 1,
            'code' => 'first',
        ]);

        $second = new Attribute([
            'id'   => 2,
            'code' => 'second',
        ]);

        $third = new Attribute([
            'id'   => 3,
            'code' => 'third',
        ]);

        $product->attributes = [$first, $second, $third];

        return $product;
    }
}