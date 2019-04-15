<?php
/**
 * Created by PhpStorm.
 * User: ddis
 * Date: 09.03.19
 * Time: 9:36
 */

namespace SphereMall\MS\Lib\Elastic\Filter\Params;


use SphereMall\MS\Lib\Elastic\Interfaces\ElasticBodyElementInterface;
use SphereMall\MS\Lib\Elastic\Interfaces\ElasticParamBuilderInterface;
use SphereMall\MS\Lib\Elastic\Interfaces\ElasticParamElementInterface;
use SphereMall\MS\Lib\Elastic\Queries\TermsQuery;

/**
 * Class FunctionalNamesParams
 *
 * @package SphereMall\MS\Lib\Elastic\Filter\Params
 */
class FunctionalNamesParams extends BasicParams implements ElasticParamElementInterface, ElasticParamBuilderInterface
{
    private $values = [];

    /**
     * FunctionalNamesParams constructor.
     *
     * @param array       $values
     * @param string|null $operator
     *
     * @throws \Exception
     */
    public function __construct(array $values, string $operator = null)
    {
        $this->values = $values;
        $this->setOperator($operator);
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'functionalNames' => [
                'values'   => $this->values,
                'operator' => $this->operator,
            ],
        ];
    }

    /**
     * @return array
     */
    public function createFilter(): array
    {
        return [
            new TermsQuery("functionalNameId", $this->values),
            $this->operator,
        ];
    }
}
