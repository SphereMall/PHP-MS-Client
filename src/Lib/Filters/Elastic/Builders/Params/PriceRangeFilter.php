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

class PriceRangeFilter implements ParamFilterElementInterface
{
    private $priceRanges = [];

    public function __construct(PriceRangeElement ...$priceRanges)
    {
        $this->priceRanges = array_map(function ($range) {
            /**@var $range PriceRangeElement* */
            return $range->getPrices();
        }, $priceRanges);
    }

    public function getParams(): array
    {
        return [
            'priceRange' => $this->priceRanges,
        ];
    }
}
