<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 04.12.18
 * Time: 9:53
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticQueryInterface;

abstract class BasicQueryBuilder implements ElasticQueryInterface
{
    /**
     * @param array $elements
     *
     * @return array
     */
    public function buildQuery(array $elements): array
    {
        $elements[] =  [
            "terms" => [
                $this->fieldName => $this->getData()
            ]
        ];

        return $elements;
    }
}
