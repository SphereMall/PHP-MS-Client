<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 18.03.2019
 * Time: 16:29
 */

namespace SphereMall\MS\Tests\Resources\Marketing;

use SphereMall\MS\Entities\ActionType;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class ActionsTypesResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $actionsTypes = $this->client->actionsTypes();
        $list = $actionsTypes->all();

        foreach ($list as $item) {
            $this->assertInstanceOf(ActionType::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $actionsType = $this->client->actionsTypes();
        $testId = 1;
        $receivedId = $actionsType->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $actionsType = $this->client->actionsTypes()->first();
        $this->assertInstanceOf(ActionType::class, $actionsType);
    }
}
