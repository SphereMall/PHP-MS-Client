<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\Trigger;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class TriggersResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $triggers = $this->client->triggers();
        $list = $triggers->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(Trigger::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $trigger = $this->client->triggers();
        $testId = 1;
        $receivedId = $trigger->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $trigger = $this->client->triggers()->first();
        $this->assertInstanceOf(Trigger::class, $trigger);
    }
}
