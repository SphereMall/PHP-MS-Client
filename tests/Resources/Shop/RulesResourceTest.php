<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 26.04.2018
 * Time: 10:11
 */

namespace SphereMall\MS\Tests\Resources\Shop;

use SphereMall\MS\Entities\Rule;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class RulesResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testGetList()
    {
        $all = $this->client->rules()->all();

        foreach ($all as $item) {
            $this->assertInstanceOf(Rule::class, $item);
        }
    }
    #endregion
}
