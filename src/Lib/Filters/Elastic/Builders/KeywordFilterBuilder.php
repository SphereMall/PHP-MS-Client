<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 17:26
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders;


use SphereMall\MS\Lib\Filters\Interfaces\ElasticFilterInterface;

class KeywordFilterBuilder implements ElasticFilterInterface
{
    private $value  = '';
    private $fields = [];

    public function __construct(string $value, array $fields)
    {
        $this->value  = $value;
        $this->fields = $fields;
    }

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
