<?php

namespace SphereMall\MS\Tests\Resources\Grapher;

use GuzzleHttp\Exception\GuzzleException;
use SphereMall\MS\Entities\EntityRelevance;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

/**
 * Class EntityRelevanceResourceTest
 *
 * @package SphereMall\MS\Tests\Resources\Grapher
 */
class EntityRelevanceResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testCRUD()
    {
        $this->assertNotEmpty($this->client->entityRelevance()->all());
        $this->assertInstanceOf(EntityRelevance::class, $this->client->entityRelevance()->get(1));
    }

    /**
     * @throws GuzzleException
     */
    public function testGetByUser()
    {
        $result = $this->client->entityRelevance()->getByUser(1);
        foreach ($result as $item) {
            $this->assertInstanceOf(EntityRelevance::class, $item);
        }
    }
    #endregion
}
