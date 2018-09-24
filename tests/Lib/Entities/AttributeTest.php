<?php
/**
 * Created by PhpStorm.
 * User: DimaSarno
 * Date: 30.08.2018
 * Time: 16:25
 */

namespace SphereMall\MS\Tests\Lib\Entities;


use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class AttributeTest extends SetUpResourceTest
{

    public function testGetValue()
    {
        $attribute = $this->getMockAttribute();
        $val = $attribute->getValue();
        $this->assertEquals('test', $val);
    }

    private function getMockAttribute()
    {
        $attribute = new Attribute();
        $attributeValue1 = new AttributeValue();
        $attributeValue2 = new AttributeValue();
        $attributeValue1->title = 'test';
        $attributeValue1->value = 'test';
        $attributeValue2->title = 'tes2';
        $attributeValue2->value = 'test2';
        $attribute->values[] = $attributeValue1;
        $attribute->values[] = $attributeValue2;
        return $attribute;
    }

}