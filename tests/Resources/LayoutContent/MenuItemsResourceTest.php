<?php

namespace SphereMall\MS\Tests\Resources\LayoutContent;

use SphereMall\MS\Entities\MenuItem;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class MenuItemsResourceTest extends SetUpResourceTest
{
    public function testMenuItemsGetList()
    {
        foreach ($this->client->menuItems()->all() as $item) {
            $this->assertInstanceOf(MenuItem::class, $item);
        }
    }
}