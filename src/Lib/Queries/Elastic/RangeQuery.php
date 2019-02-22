<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 22.02.19
 * Time: 17:19
 */

namespace SphereMall\MS\Lib\Queries\Elastic;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

/**
 * Class RangeQuery
 *
 * @package SphereMall\MS\Lib\Queries\Elastic
 */
class RangeQuery extends BasicQuery implements ElasticFilterInterface
{
    private $field = null;
    private $range = [];

    /**
     * RangeQuery constructor.
     *
     * @param string $field
     * @param array  $range
     */
    public function __construct(string $field, array $range)
    {
        $this->field = $field;
        $this->range = $range;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'range' => [
                $this->field => $this->range,
            ],
        ];
    }
}
