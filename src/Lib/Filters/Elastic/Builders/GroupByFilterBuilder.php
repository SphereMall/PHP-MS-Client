<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 17:21
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

/**
 * Class GroupByFilterBuilder
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders
 */
class GroupByFilterBuilder implements ElasticFilterInterface
{
    private $field = '';

    /**
     * GroupByFilterBuilder constructor.
     *
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'groupBy' => $this->getValues(),
        ];
    }

    public function getValues()
    {
        return $this->field;
    }
}
