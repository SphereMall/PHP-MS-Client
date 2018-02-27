<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:56
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchParamsInterface;

/**
 * Class PriceRangeFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 * @property int $priceMin
 * @property int $priceMax
 */
class PriceRangeFilterParams extends FilterParams implements SearchParamsInterface
{
    protected $priceMin;
    protected $priceMax;

    /**
     * PriceRangeFilterParams constructor.
     * @param int|null $priceMin
     * @param int|null $priceMax
     */
    public function __construct(int $priceMin = null, int $priceMax = null)
    {
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return [$this->priceMin, $this->priceMax];
    }
}
