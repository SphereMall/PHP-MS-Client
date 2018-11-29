<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 17:26
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

/**
 * Class KeywordFilterBuilder
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders
 */
class KeywordFilterBuilder implements ElasticFilterInterface
{
    private $value  = '';
    private $fields = [];

    /**
     * KeywordFilterBuilder constructor.
     *
     * @param string $value
     * @param array  $fields
     */
    public function __construct(string $value, array $fields)
    {
        $this->value  = $value;
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            'keyword' => json_encode([
                'value'  => $this->value,
                'fields' => $this->fields,
            ]),
        ];
    }
}
