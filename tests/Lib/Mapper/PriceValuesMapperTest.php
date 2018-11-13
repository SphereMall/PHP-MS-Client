<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 11/13/18
 * Time: 11:19 AM
 */

namespace SphereMall\MS\Tests\Lib\Mapper;

use PHPUnit\Framework\TestCase;
use SphereMall\MS\Entities\Price\ProductPriceConfiguration;
use SphereMall\MS\Lib\Mappers\PriceValuesMapper;

/**
 * Class PriceValuesMapperTest
 * @package SphereMall\MS\Tests\Lib\Mapper
 */
class PriceValuesMapperTest extends TestCase
{
    protected $mockPrices = '[{"productId":"1","vatId":"0","productVatId":"2","prices":{"priceWithVat":"142994","priceWithoutVat":"134900"},"vatPercent":"6.00","transport":{"productId":"1","attributesHash":"null","options":"null"}},{"productId":"2","vatId":"0","productVatId":"3","priceWithVat":"163229","priceWithoutVat":"134900","vatPercent":"21.00","transport":{"productId":2,"attributesHash":"null","options":"null"}}]';

    public function testCanBeUsedAsString(): void
    {
        $mockPrices = json_decode($this->mockPrices, true);
        $mapper = new PriceValuesMapper();
        /** @var ProductPriceConfiguration $productPriceConfiguration */
        $productPriceConfiguration = $mapper->createObject($mockPrices[0]);

        $this->assertEquals(0, $productPriceConfiguration->vatId);
        $this->assertEquals(2, $productPriceConfiguration->productVatId);
        $this->assertEquals(142994, $productPriceConfiguration->priceWithVat);
        $this->assertEquals(134900, $productPriceConfiguration->priceWithoutVat);
        $this->assertEquals("6.00", $productPriceConfiguration->vatPercent);

        /** @var ProductPriceConfiguration $productPriceConfiguration */
        $productPriceConfiguration = $mapper->createObject($mockPrices[1]);

        $this->assertEquals(0, $productPriceConfiguration->vatId);
        $this->assertEquals(3, $productPriceConfiguration->productVatId);
        $this->assertEquals(163229, $productPriceConfiguration->priceWithVat);
        $this->assertEquals(134900, $productPriceConfiguration->priceWithoutVat);
        $this->assertEquals("21.00", $productPriceConfiguration->vatPercent);
    }
}
