<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:23
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;

use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

/**
 * Class BrandsFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params
 */
class BrandsFilter implements ParamFilterElementInterface
{
    private $brands = [];

    /**
     * BrandsFilter constructor.
     *
     * @param array $brands
     */
    public function __construct(array $brands)
    {
        foreach ($brands as $brand) {
            $this->setBrand($brand);
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return ['brands' => $this->brands];
    }

    /**
     * @param int $brand
     *
     * @return $this
     */
    public function setBrand(int $brand)
    {
        $this->brands[] = $brand;

        return $this;
    }
}
