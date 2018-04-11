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

/**
 * Class SetUpResourceTest
 * @package SphereMall\MS\Tests\Resources
 *
 * @property Client $client
 */
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
    /**
     * @throws \SphereMall\MS\Exceptions\ConfigurationException
     */
    protected function setUp()
    {
        $this->client = new Client([
            'gatewayUrl' => MS_URL_GATEWAY,
            'clientId'   => MS_CLIENT_ID,
            'secretKey'  => MS_SECRET_KEY
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
