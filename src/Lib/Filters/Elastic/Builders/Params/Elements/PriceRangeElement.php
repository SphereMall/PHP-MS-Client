<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 18:36
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params\Elements;


class PriceRangeElement
{
    private $min = 0;
    private $max = 0;

    public function __construct(int $min = 0, int $max = 0)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getPrices()
    {
        $result = [];
        if ($this->min) {
            $result['min'] = $this->min;
        }
        if ($this->max) {
            $result['max'] = $this->max;
        }

        return $result;
    }
}
