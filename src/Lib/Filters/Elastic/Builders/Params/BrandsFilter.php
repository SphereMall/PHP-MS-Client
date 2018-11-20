<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:23
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

class BrandsFilter implements ParamFilterElementInterface
{
    private $brands = [];

    public function __construct(array $brands)
    {
        foreach ($brands as $brand) {
            $this->setBrand($brand);
        }
    }

    public function getParams(): array
    {
        return ['brands' => $this->brands];
    }

    public function setBrand(int $brand)
    {
        $this->brands[] = $brand;

        return $this;
    }
}
