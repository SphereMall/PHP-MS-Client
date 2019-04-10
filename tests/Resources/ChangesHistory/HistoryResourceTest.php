<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 01.04.2019
 * Time: 10:56
 */

namespace SphereMall\MS\Tests\Resources\ChangesHistory;

use SphereMall\MS\Entities\History;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class HistoryResourceTest extends SetUpResourceTest
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testServiceGetList()
    {
        $histories = $this->client->history();
        $list = $histories->all();
        foreach ($list as $item) {
            $this->assertInstanceOf(History::class, $item);
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetById()
    {
        $history = $this->client->history();
        $testId = 1;
        $receivedId = $history->get($testId)->id;
        $this->assertEquals($testId, $receivedId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFirst()
    {
        $history = $this->client->history()->first();
        $this->assertInstanceOf(History::class, $history);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testAddHistory()
    {
        $params = [
            'userType' => 'user',
            'userId'   => 33,
            'fields'   => "[{\"userType\":\"user\",\"userId\":\"1\",\"fieldName\":\"title json 1\",\"oldValue\":\"some oldValue json 1\",\"newValue\":\"some newValue json 1\"},
                    {\"fieldName\":\"title json 2\",\"oldValue\":\"some oldValue json 2\"},
                    {\"fieldName\":\"title json 3\"}]",
        ];

        $historyList = $this->client->history()->addHistory('products', 50, $params);

        $this->assertInternalType('array', $historyList);
        $this->assertEquals(3, count($historyList));
        $this->assertInstanceOf(History::class, $historyList[0]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testGetListByObjectType()
    {
        $historyList = $this->client->history()->limit(2, 1)->getHistoryByEntityAndId('products', 50);

        $this->assertInternalType('array', $historyList);
        $this->assertEquals(2, count($historyList));
        $this->assertInstanceOf(History::class, $historyList[0]);
    }
}
