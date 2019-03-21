<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 21.03.19
 * Time: 14:14
 */

namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms;

use SphereMall\MS\Lib\Elastic\Filter\Factors\FilterFactorValue;
use stdClass;

/**
 * Class MathSumWithFactor
 *
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms
 */
class MathSumWithFactor extends BasicAlgorithm
{
    const DEFAULT_FACTOR = 1;

    private $factorItem = [];

    /**
     * MathSumWithFactor constructor.
     *
     * @param array $factors
     */
    public function __construct(array $factors)
    {
        foreach ($factors as $factor) {
            $this->setFactor($factor);
        }
    }

    /**
     * @param FilterFactorValue $factor
     *
     * @return $this
     */
    public function setFactor(FilterFactorValue $factor)
    {
        $this->factorItem[$factor->getId()] = $factor->getCoefficient();

        return $this;
    }

    /**
     * @return array
     */
    public function getAlgorithm(): array
    {
        return [
            'lang'   => 'painless',
            'source' => $this->getScriptSource(),
            'params' => $this->getParams(),
        ];
    }

    /**
     * @return string
     */
    private function getScriptSource()
    {
        return "double score = 0;
                double value = 0;
                double factor = 1;
                for(int i=0; i < params.factorValuesId.length; i++){     
                  try {
                    factor = params.factors[params.factorValuesId[i]];
                  } catch (NullPointerException e) {
                    factor = " . self::DEFAULT_FACTOR . ";
                  }
                  
                  try {
                    if (doc[params.factorValuesId[i] + '.value'].value == 0.0){
                      value = 0;
                    } 
                    value = doc[params.factorValuesId[i] + '.value'].value;
                  } catch (IllegalArgumentException e) {
                    value = 0;
                  }
                  score += (value * factor);
                }
                return score;";
    }

    /**
     * @return array
     */
    private function getParams()
    {
        $factorValues = [];
        $factors      = new StdClass();
        foreach ($this->factorItem as $valueId => $coefficient) {
            $factorValueName = "{$valueId}_factorValues";

            $factorValues[]              = $factorValueName;
            $factors->{$factorValueName} = $coefficient;
        }

        return [
            'factors'        => $factors,
            'factorValuesId' => $factorValues,
        ];
    }

}
