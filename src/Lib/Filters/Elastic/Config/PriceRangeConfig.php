<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 12:32
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigElementInterface;

class PriceRangeConfig implements ElasticConfigElementInterface
{
    private $use = false;

    public function __construct(bool $use)
    {
        $this->use = $use;
    }

    /**
     * @return mixed
     */
    public function getElements(): array
    {
        return [
            'priceRange' => $this->use,
        ];
    }
}
