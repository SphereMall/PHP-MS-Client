<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */

namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Entities\AttributeGroup;

class AttributeGroupsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testBrandsServiceGetList()
    {
        $attributeGroups = $this->client->attributeGroups();
        $list = $attributeGroups->all();

        foreach ($list as $group) {
            $this->assertInstanceOf(AttributeGroup::class, $group);
        }
    }

    #endregion
}
