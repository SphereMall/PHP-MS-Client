<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\EventActionCampaign;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class EventActionCampaignResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $eventActionCampaigns = $this->client->eventActionCampaign();
        $list = $eventActionCampaigns->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(EventActionCampaign::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $eventActionCampaign = $this->client->eventActionCampaign();
        $testId = 6;
        $receivedId = $eventActionCampaign->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $eventActionCampaign = $this->client->eventActionCampaign()->first();
        $this->assertInstanceOf(EventActionCampaign::class, $eventActionCampaign);
    }
}
