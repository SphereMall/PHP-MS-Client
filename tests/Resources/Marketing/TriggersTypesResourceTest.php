<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\TriggerType;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class TriggersTypesResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $triggersTypes = $this->client->triggersTypes();
        $list = $triggersTypes->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(TriggerType::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $triggersType = $this->client->triggersTypes();
        $testId = 1;
        $receivedId = $triggersType->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $triggersType = $this->client->triggersTypes()->first();
        $this->assertInstanceOf(TriggerType::class, $triggersType);
    }
}
