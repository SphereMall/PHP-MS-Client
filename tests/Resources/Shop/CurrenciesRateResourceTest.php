<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\CurrencyRate;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class CurrenciesRateResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->currenciesRate()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(CurrencyRate::class, $item);
        }
    }
    #endregion
}
