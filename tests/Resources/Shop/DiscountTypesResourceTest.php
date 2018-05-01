<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 01.05.2018
 * Time: 12:52
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\DiscountType;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class DiscountTypesResourceTest extends SetUpResourceTest
{
    public function testGetList()
    {
        $all = $this->client->discountTypes()->all();

        /**
         * @var $item DiscountType
         */
        foreach ($all as $item) {
            $this->assertInstanceOf(DiscountType::class, $item);
            $this->assertNotEmpty($item->title);
        }
    }
}
