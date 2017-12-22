<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/22/2017
 * Time: 2:34 PM
 */

namespace SphereMall\MS\Tests\Lib\Traits;

use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Order;
use SphereMall\MS\Lib\Shop\OrderFinalized;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class InteractsWithPropertiesTest extends SetUpResourceTest
{
    public function testGetProperty()
    {
        $document = new Document([
            'id'   => 1,
            'test' => 'test-value',
        ]);

        $this->assertEquals('test-value', $document->test);
        $this->assertEquals('test-value', $document->getProperty('test'));

        $order = new Order([
            'id'   => 1,
            'test' => 'test-value',
        ]);

        $orderFinalized = new OrderFinalized($this->client);
        $orderFinalized->setOrderData($order);

        $this->assertEquals('test-value', $orderFinalized->test);
        $this->assertEquals('test-value', $orderFinalized->getProperty('test'));
    }
}