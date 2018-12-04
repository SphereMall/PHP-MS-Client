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

/**
 * Class ParamsFilterBuilder
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders
 */
class ParamsFilterBuilder implements ElasticFilterInterface
{
    private $params = [];

    /**
     * ParamsFilterBuilder constructor.
     *
     * @param ParamFilterInterface ...$filters
     */
    public function __construct(ParamFilterInterface ...$filters)
    {
        $this->params = array_map(function ($filter) {
            /**@var $filter ParamFilterInterface* */
            return $filter->getFilters();
        }, $filters);
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'params' => json_encode($this->getValues()),
        ];
    }


    public function getValues()
    {
        return $this->params;
    }
}
