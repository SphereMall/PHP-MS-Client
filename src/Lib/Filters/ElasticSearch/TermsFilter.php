<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 12:29
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

/**
 * Class TermsFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 */
class TermsFilter extends ElasticSearchFilterElement
{
    protected $name = 'terms';

    /**
     * @return array
     */
    public function getValues()
    {
        $data = [];
        foreach ($this->values as $key => $value) {
            $data = [$this->getName() => [$key => $value]];
        }

        return $data;
    }
}
