<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Entities\AttributeGroup;
use SphereMall\MS\Resources\Resource;

/**
 * Class AttributeGroupsResource
 * @package SphereMall\MS\Resources\Products
 * @method AttributeGroup get(int $id)
 * @method AttributeGroup[] all()
 * @method AttributeGroup update()
 * @method AttributeGroup create()
 */
class AttributeGroupsResource extends Resource
{
    public function getURI()
    {
        return "attributegroups";
    }

}