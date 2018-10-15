<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 12.10.18
 * Time: 11:37
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms;

abstract class BasicAlgorithm
{
    protected $factorValuesIds = [];

    /**
     * MathSum constructor.
     *
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->setFactorValuesIds($ids);
    }

    /**
     * @param array $factorValuesIds
     *
     * @return BasicAlgorithm
     */
    protected function setFactorValuesIds(array $factorValuesIds): BasicAlgorithm
    {
        foreach ($factorValuesIds as $id) {
            $this->factorValuesIds[] = "{$id}_factorValues";
        }

        return $this;
    }

    /**
     * @return array
     */
    abstract public function getAlgorithm(): array;
}
