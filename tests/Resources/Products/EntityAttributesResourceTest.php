<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources\Products;

use SphereMall\MS\Entities\EntityAttribute;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class EntityAttributesResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testServiceGetList()
    {
        $entityAttributes = $this->client->entityAttributes();
        $list = $entityAttributes->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(EntityAttribute::class, $item);
        }

    }
    #endregion
}