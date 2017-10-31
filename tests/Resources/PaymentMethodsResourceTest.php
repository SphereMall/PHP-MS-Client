<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\PaymentMethod;

class PaymentMethodsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testBrandsServiceGetList()
    {
        $paymentMethods = $this->client->paymentMethods();
        $methods = $paymentMethods->all();

        foreach ($methods as $method) {
            $this->assertInstanceOf(PaymentMethod::class, $method);
        }
    }

    #endregion
}
