<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 16:39
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

class ElasticFilterBuilder implements ElasticFilterInterface
{
    private $params = [];

    public function __construct(ElasticFilterInterface ...$filters)
    {
        foreach ($filters as $filter) {
            $this->params += $filter->getParams();
        }
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
