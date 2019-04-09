<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\UserTrigger;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class UserTriggersResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $userTriggers = $this->client->userTriggers();
        $list = $userTriggers->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(UserTrigger::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $userTrigger = $this->client->userTriggers();
        $testId = 3;
        $receivedId = $userTrigger->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $userTrigger = $this->client->userTriggers()->first();
        $this->assertInstanceOf(UserTrigger::class, $userTrigger);
    }
}
