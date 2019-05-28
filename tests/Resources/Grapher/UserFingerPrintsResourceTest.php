<?php

namespace SphereMall\MS\Tests\Resources\Grapher;

use GuzzleHttp\Exception\GuzzleException;
use SphereMall\MS\Entities\UserFingerPrints;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

/**
 * Class UserFingerprintsResourceTest
 *
 * @package SphereMall\MS\Tests\Resources\Grapher
 */
class UserFingerPrintsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testCRUD()
    {
        $this->assertNotEmpty($this->client->userFingerprints()->all());
        $this->assertInstanceOf(UserFingerPrints::class, $this->client->userFingerprints()->get(1));
    }

    /**
     * @throws GuzzleException
     */
    public function testGetByUser()
    {
        $result = $this->client->userUidHash()->getByUser(1);
        foreach ($result as $item) {
            $this->assertInstanceOf(UserFingerPrints::class, $item);
        }
    }
    #endregion
}
