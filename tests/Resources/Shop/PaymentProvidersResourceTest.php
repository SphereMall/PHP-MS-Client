<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\PaymentProvider;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class PaymentProvidersResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->paymentProviders()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(PaymentProvider::class, $item);
        }
    }
    #endregion
}
