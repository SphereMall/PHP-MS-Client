<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\Campaign;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class CampaignsResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $campaigns = $this->client->campaigns();
        $list = $campaigns->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(Campaign::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $campaign = $this->client->campaigns();
        $testId = 1;
        $receivedId = $campaign->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $campaign = $this->client->campaigns()->first();
        $this->assertInstanceOf(Campaign::class, $campaign);
    }
}
