<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 18:30
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;

use SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements\PriceRangeElement;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

/**
 * Class PriceRangeFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params
 */
class PriceRangeFilter extends BasicQueryBuilder implements ParamFilterElementInterface
{
    private $priceRanges = [];

    /**
     * PriceRangeFilter constructor.
     *
     * @param PriceRangeElement ...$priceRanges
     */
    public function __construct(array $priceRanges)
    {
        $this->priceRanges = array_map(function ($range) {
            if (is_a($range, PriceRangeElement::class)) {
                /**@var $range PriceRangeElement* */
                return $range->getPrices();
            }

            return $range;
        }, $priceRanges);
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'priceRange' => $this->priceRanges,
        ];
    }

    public function getData()
    {
        return $this->priceRanges;
    }

    public function buildQuery(array $elements): array
    {
        $ranges = [];

        foreach ($this->getData() as $index => $datum) {

            $price = [];

            if (isset($datum['min']) && $datum['min']) {
                $price['gte'] = $datum['min'];
            }

            if (isset($datum['max']) && $datum['max']) {
                $price['lte'] = $datum['max'];
            }

            if ($price) {
                $ranges[] = [
                    'range' => [
                        'price' => $price,
                    ],
                ];
            }

        }
        if ($ranges) {
            $elements[] = [
                "bool" => [
                    "should" => $ranges,
                ],
            ];
        }

        return $elements;
    }
}
