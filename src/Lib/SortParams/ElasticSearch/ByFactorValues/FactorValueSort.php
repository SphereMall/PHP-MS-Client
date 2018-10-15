<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 12.10.18
 * Time: 11:36
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues;

use SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms\BasicAlgorithm;
use SphereMall\MS\Lib\SortParams\SortParams;

class FactorValueSort extends SortParams
{
    private $algorithm = null;

    /**
     * FactorValueSort constructor.
     *
     * @param BasicAlgorithm $algorithm
     * @param string         $order
     */
    public function __construct(BasicAlgorithm $algorithm, $order = 'desc')
    {
        $this->algorithm = $algorithm;
        $this->order     = $order;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            '_script' => [
                'type'   => 'number',
                'script' => $this->algorithm->getAlgorithm(),
                'order'  => $this->order,
            ],
        ];
    }
}
