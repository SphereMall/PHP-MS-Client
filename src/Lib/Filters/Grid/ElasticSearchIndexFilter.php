<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:41
 */

namespace SphereMall\MS\Lib\Filters\Grid;

use SphereMall\MS\Lib\Helpers\ElasticSearchIndexHelper;

class ElasticSearchIndexFilter extends ElasticSearchFilterElement
{
    #region [Properties]
    protected $name = 'index';
    #endregion

    #region [Constructor]
    /**
     * ElasticSearchIndexFilter constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $values = array_map(function ($item) {
            return ElasticSearchIndexHelper::getIndexByClass($item);
        }, $values);

        parent::__construct($values);
    }
    #endregion
}
