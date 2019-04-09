<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\UserTriggerHistory;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class UserTriggerHistoryResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $userTriggerHistories = $this->client->userTriggerHistory();
        $list = $userTriggerHistories->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(UserTriggerHistory::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $userTriggerHistory = $this->client->userTriggerHistory();
        $testId = 3;
        $receivedId = $userTriggerHistory->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $userTriggerHistory = $this->client->userTriggerHistory()->first();
        $this->assertInstanceOf(UserTriggerHistory::class, $userTriggerHistory);
    }
}
