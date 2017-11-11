<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\AttributeDisplayType;
use SphereMall\MS\Entities\AttributeType;

class AttributeTypesResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testBrandsServiceGetList()
    {
        $attributeDisplayTypes = $this->client->attributeTypes();
        $list = $attributeDisplayTypes->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(AttributeType::class, $item);
        }
    }

    #endregion
}
