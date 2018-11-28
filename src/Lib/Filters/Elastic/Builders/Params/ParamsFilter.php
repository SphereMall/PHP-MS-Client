<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 18:20
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterInterface;

class ParamsFilter implements ParamFilterInterface
{
    private $elements = [];

    public function __construct(array $params)
    {
        foreach ($params as $param) {
            $this->setParam($param);
        }
    }

    public function getFilters(): array
    {
        return $this->elements;
    }

    public function setParam(ParamFilterElementInterface $param)
    {
        $this->elements += $param->getParams();
    }
}
