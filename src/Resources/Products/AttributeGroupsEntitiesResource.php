<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Products;

use SphereMall\MS\Entities\AttributeGroupsEntities;
use SphereMall\MS\Resources\Resource;

/**
 * Class AttributeGroupsEntitiesResource
 * @package SphereMall\MS\Resources\Products
 * @method AttributeGroupsEntities get(int $id)
 * @method AttributeGroupsEntities[] all()
 * @method AttributeGroupsEntities update()
 * @method AttributeGroupsEntities create()
 */
class AttributeGroupsEntitiesResource extends Resource
{
    public function getURI()
    {
        return "attributegroupsentities";
    }

}