<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\Event;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class EventsResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $events = $this->client->events();
        $list = $events->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(Event::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $event = $this->client->events();
        $testId = 1;
        $receivedId = $event->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $event = $this->client->events()->first();
        $this->assertInstanceOf(Event::class, $event);
    }
}
