<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 20:02
 */
namespace SphereMall\MS\Tests\Resources;

use SphereMall\MS\Client;

class SetUpResourceTest extends \PHPUnit\Framework\TestCase
{
    #region [Properties]

    /**
     * @var Client
     */
    protected $client;

    private $testVal = 1;
    #endregion

    #region [SetUp]
    protected function setUp()
    {
        $this->client = new Client([
            'gatewayUrl' => API_GATEWAY_URL,
            'clientId'   => API_CLIENT_ID,
            'secretKey'  => API_SECRET_KEY
        ]);
    }
    #endregion

    #region [Tests methods]
    public function testClassSetUp()
    {
        $this->assertEquals(1, $this->testVal);
    }
    #endregion
}
