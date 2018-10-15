<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 15.10.18
 * Time: 8:48
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms;

/**
 * Class MathSum
 *
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms
 */
class MathSum extends BasicAlgorithm
{
    /**
     * @return array
     */
    public function getAlgorithm(): array
    {
        return [
            'lang'   => 'painless',
            'source' => $this->getScriptSource(),
            'params' => [
                'factors' => $this->factorValuesIds,
            ],
        ];
    }

    private function getScriptSource()
    {
        return "double score = 0;
            double value = 0;
            for(int i=0; i < params.factors.length; i++){
              try {
                if (doc[params.factors[i] + '.value'].value == 0.0){
                  value = 0;
                } 
                value = doc[params.factors[i] + '.value'].value;
              } catch (IllegalArgumentException e) {
                value = 0;
              }
              score += value;
            }
            return score;";
    }
}


