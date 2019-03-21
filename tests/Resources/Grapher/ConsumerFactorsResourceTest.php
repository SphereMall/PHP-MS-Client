<?php
namespace SphereMall\MS\Tests\Resources\Grapher;

use SphereMall\MS\Entities\ConsumerFactorHistory;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

/**
 * Class ConsumerFactorsResourceTest
 *
 * @package SphereMall\MS\Tests\Resources\Grapher
 */
class ConsumerFactorsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    /**
     * @test
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function set_entity_factors()
    {
        $userId  = 1;
        $factors = [
            [
                'factorId'      => 2,
                'factorValueId' => 57,
                'value'         => 0.7,
            ],
            [
                'factorId' => 4,
                'value'    => 'comment',
            ],
        ];
        $context = [
            'type' => 'Page',
            'id'   => 123,
        ];
        $consumerFactors  = $this->client->consumerFactors()->set($userId, $factors, $context);
        $this->assertNotEmpty($consumerFactors);
        if (is_array($consumerFactors)) {
            foreach ($consumerFactors as $consumerFactor) {
                $this->assertInstanceOf(ConsumerFactorHistory::class, $consumerFactor);
            }
        } else {
            $this->assertInstanceOf(ConsumerFactorHistory::class, $consumerFactors);
        }
    }
    #endregion
}
