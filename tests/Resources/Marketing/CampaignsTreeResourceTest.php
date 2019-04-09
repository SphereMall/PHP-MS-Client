<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:30
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\CampaignTree;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class CampaignsTreeResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $campaignsTrees = $this->client->campaignsTree();
        $list = $campaignsTrees->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(CampaignTree::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $campaignsTree = $this->client->campaignsTree()->first();
        $this->assertInstanceOf(CampaignTree::class, $campaignsTree);
    }
}
