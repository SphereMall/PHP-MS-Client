<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:41
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\ElasticSearch\IndexFilterParams;
use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\Helpers\ElasticSearchIndexHelper;

class ElasticSearchIndexFilter extends ElasticSearchFilterElement
{
    #region [Properties]
    protected $name = 'index';
    #endregion

    #region [Constructor]
    /**
     * ElasticSearchIndexFilter constructor.
     * @param FilterParams $values
     * @param string       $lang
     */
    public function __construct(FilterParams $values, string $lang = null)
    {
        $values = array_map(function ($item) {
            return ElasticSearchIndexHelper::getIndexByClass($item);
        }, $values->getParams());

        parent::__construct(new IndexFilterParams($values), $lang);
    }
    #endregion
}
