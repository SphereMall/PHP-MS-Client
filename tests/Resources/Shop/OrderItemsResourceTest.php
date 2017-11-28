<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\OrderItem;
use SphereMall\MS\Entities\OrderStatus;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class OrderItemsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->orderItems()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(OrderItem::class, $item);
        }
    }
    #endregion
}
