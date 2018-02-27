<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:12
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\FacetedParamsInterface;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchParamsInterface;

/**
 * Class TermsFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 * @property string $field
 * @property array  $values
 */
class TermsFilterParams extends FilterParams implements SearchParamsInterface, FacetedParamsInterface
{
    protected $field;
    protected $values;

    /**
     * TermsFilterParams constructor.
     * @param string $field
     * @param array  $values
     */
    public function __construct(string $field, array $values)
    {
        $this->field  = $field;
        $this->values = $values;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getParams()
    {
        return [$this->field => $this->values];
    }

    /**
     * @return array
     */
    public function getFacetedParams(): array
    {
        return ['field' => $this->field];
    }
}
