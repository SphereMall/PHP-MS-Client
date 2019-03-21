<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 21.03.19
 * Time: 14:40
 */

namespace SphereMall\MS\Lib\Elastic\Filter\Factors;


use SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms\MathSumWithFactor;

/**
 * Class FilterFactorValue
 *
 * @package SphereMall\MS\Lib\Elastic\Filter\Factors
 */
class FilterFactorValue
{
    private $id          = 0;
    private $coefficient = 0;

    /**
     * FilterFactorValue constructor.
     *
     * @param int   $id
     * @param float $coefficient
     */
    public function __construct(int $id, float $coefficient = MathSumWithFactor::DEFAULT_FACTOR)
    {
        $this->id          = $id;
        $this->coefficient = $coefficient;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float|int
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }
}
