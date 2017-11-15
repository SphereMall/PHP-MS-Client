<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\DeliveryProvider;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class DeliveryResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testDeliveryGetList()
    {
        $deliveryProviders = $this->client->deliveryProviders()->all();
        $this->assertInstanceOf(DeliveryProvider::class, $deliveryProviders[0]);
    }
    #endregion
}
