<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 17:21
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

class GroupByFilterBuilder implements ElasticFilterInterface
{
    private $field = '';

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function getParams(): array
    {
        return [
            'groupBy' => $this->field,
        ];
    }
}
