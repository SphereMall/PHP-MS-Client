<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class GridResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $all = $this->client->grid()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    #endregion
}
