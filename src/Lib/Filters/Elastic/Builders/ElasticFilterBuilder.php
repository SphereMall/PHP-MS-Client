<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 16:39
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

/**
 * Class ElasticFilterBuilder
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders
 */
class ElasticFilterBuilder implements ElasticFilterInterface
{
    private $params = [];

    /**
     * ElasticFilterBuilder constructor.
     *
     * @param ElasticFilterInterface ...$filters
     */
    public function __construct(ElasticFilterInterface ...$filters)
    {
        foreach ($filters as $filter) {
            $this->params += $filter->getParams();
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
