<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 14:58
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigElementInterface;

class FactorValuesConfig implements ElasticConfigElementInterface
{
    private $factorValues = [];

    public function __construct(array $factorValues)
    {
        foreach ($factorValues as $factorValue) {
            $this->setFactorValues($factorValue);
        }
    }

    public function getElements(): array
    {
        return [
            'factorValues' => $this->factorValues,
        ];
    }

    private function setFactorValues(int $factorValue)
    {
        $this->factorValues[] = $factorValue;

        return $this;
    }
}
