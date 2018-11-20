<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 18:14
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;
use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterInterface;

class ParamsFilterBuilder implements ElasticFilterInterface
{
    private $params = [];

    public function __construct(ParamFilterInterface ...$filters)
    {
        $this->params = array_map(function ($filter) {
            /**@var $filter ParamFilterInterface**/
            return $filter->getFilters();
        }, $filters);
    }

    public function getParams(): array
    {
        return [
            'params' => json_encode($this->params),
        ];
    }


}
