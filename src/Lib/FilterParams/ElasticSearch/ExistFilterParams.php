<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 16:12
 */

namespace SphereMall\MS\Lib\FilterParams\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchFacetedInterface;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchQueryInterface;

/**
 * Class TermsFilterParams
 * @package SphereMall\MS\Lib\FilterParams\ElasticSearch
 * @property string $field
 * @property array  $values
 */
class ExistFilterParams extends FilterParams implements SearchQueryInterface, SearchFacetedInterface
{
    protected $field;
    protected $values;

    /**
     * TermsFilterParams constructor.
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field  = $field;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getParams()
    {
        return ["field" => $this->field];
    }

    /**
     * @return array
     */
    public function getFacetedParams(): array
    {
        return ["field" => $this->field];
    }
}
