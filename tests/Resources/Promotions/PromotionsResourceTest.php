<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 02.05.2018
 * Time: 10:12
 */

namespace SphereMall\MS\Tests\Resources\Promotions;

use SphereMall\MS\Entities\Promotion;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class PromotionsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $all = $this->client->promotions()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Promotion::class, $item);
        }
    }

    #endregion
}