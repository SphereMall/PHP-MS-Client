<?php
/**
 * Created by PhpStorm.
 * User: Slavik
 * Date: 01.08.19
 * Time: 14:36
 */

namespace SphereMall\MS\Lib\Elastic\Filter\Params;

use SphereMall\MS\Lib\Elastic\Interfaces\{ElasticParamBuilderInterface, ElasticParamElementInterface};
use SphereMall\MS\Lib\Elastic\Queries\TermQuery;
use SphereMall\MS\Lib\Filters\FilterOperators;

/**
 * Class IsMainParams
 *
 * @package SphereMall\MS\Lib\Elastic\Filter\Params
 */
class IsMainParams implements ElasticParamElementInterface, ElasticParamBuilderInterface
{
    private $value;

    /**
     * IsMainParams constructor
     *
     * @param int|string $value
     *
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'isMain' => $this->value
        ];
    }

    /**
     * @return array
     */
    public function createFilter(): array
    {
        return [
            new TermQuery('isMain', $this->value),
            FilterOperators::IN,
        ];
    }
}
