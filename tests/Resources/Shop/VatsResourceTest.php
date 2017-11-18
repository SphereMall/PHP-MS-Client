<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\Vat;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class VatsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->vats()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Vat::class, $item);
        }
    }
    #endregion
}
