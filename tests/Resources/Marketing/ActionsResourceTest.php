<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:23
 */

namespace SphereMall\MS\Resources\Marketing;

use SphereMall\MS\Entities\Action;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ActionsResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $actions = $this->client->actions();
        $list = $actions->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(Action::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $action = $this->client->actions();
        $testId = 1;
        $receivedId = $action->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $action = $this->client->actions()->first();
        $this->assertInstanceOf(Action::class, $action);
    }
}
