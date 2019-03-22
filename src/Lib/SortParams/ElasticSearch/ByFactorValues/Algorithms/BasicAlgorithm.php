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
    /**
     * @return array
     */
    abstract public function getAlgorithm(): array;
}
