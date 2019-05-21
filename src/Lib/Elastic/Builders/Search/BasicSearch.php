<?php


namespace SphereMall\MS\Lib\Elastic\Builders\Search;

/**
 * Class BasicSearch
 *
 * @package SphereMall\MS\Lib\Elastic\Builders\Search
 */
abstract class BasicSearch
{
    /**
     * @param string $list
     *
     * @return string
     */
    protected function validateEntities(string $list)
    {
        $availableList = [
            'sm-products',
            'sm-documents',
            'sm-dealers',
            'sm-pages',
        ];

        return implode(",", array_filter(explode(',', $list), function ($item) use ($availableList) {
            return in_array($item, $availableList);
        }));
    }
}
