<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/29/2017
 * Time: 5:16 PM
 */

namespace SphereMall\MS\Tests\Lib\Specifications\Basic;

use SphereMall\MS\Lib\Specifications\Basic\IsActive;
use SphereMall\MS\Lib\Specifications\Basic\IsVisible;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class BasicSpecificationTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testIsVisibleSpecification()
    {
        $isVisible = new IsVisible();

        $products = $this->client
            ->products()
            ->filter($isVisible)
            ->limit(1)
            ->all();

        $this->assertEquals(1, $products[0]->visible);
        $this->assertTrue($isVisible->isSatisfiedBy($products[0]));
    }

    public function testIsActiveSpecification()
    {
        $isActive = new IsActive();

        $paymentMethods = $this->client
            ->paymentMethods()
            ->filter($isActive)
            ->limit(1)
            ->all();

        $this->assertEquals(1, $paymentMethods[0]->active);
        $this->assertTrue($isActive->isSatisfiedBy($paymentMethods[0]));
    }
    #endregion
}
