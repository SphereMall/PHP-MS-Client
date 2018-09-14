<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 12:29
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\FacetedInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;

/**
 * Class TermsFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 */
class ExistsFilter extends ElasticSearchFilterElement implements SearchInterface, FacetedInterface
{
    protected $name = 'exists';

    /**
     * @return array
     */
    public function getValues(): array
    {
        $data = [];
        foreach ($this->values as $key => $value) {
            $data = [$this->getName() => [$key => $value]];
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getFacetedValues(): array
    {
        $data = [];
        foreach ($this->facets as $key => $value) {
            $data[$value] = [$this->getName() => [$key => $value]];
        }

        return $data;
    }
}
