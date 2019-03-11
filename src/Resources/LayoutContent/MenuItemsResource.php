<?php

namespace SphereMall\MS\Resources\LayoutContent;

use SphereMall\MS\Entities\MenuItem;
use SphereMall\MS\Resources\Resource;

/**
 * Class MenuItemsResource
 * @package SphereMall\MS\Resources\Products
 * @method MenuItem get(int $id)
 * @method MenuItem first()
 * @method MenuItem[] all()
 * @method MenuItem update($id, $data)
 * @method MenuItem create($data)
 */
class MenuItemsResource extends Resource
{
    public function getURI()
    {
        return "menuitems";
    }
}