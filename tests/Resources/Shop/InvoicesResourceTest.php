<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\Invoice;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class InvoicesResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->invoices()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Invoice::class, $item);
        }
    }
    #endregion
}
