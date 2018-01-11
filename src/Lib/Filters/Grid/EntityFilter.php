<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/2/2017
 * Time: 5:51 PM
 */

namespace SphereMall\MS\Lib\Filters\Grid;

use SphereMall\MS\Lib\Helpers\CorrelationTypeHelper;

/**
 * Class EntityFilter
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 */
class EntityFilter extends GridFilterElement
{
    #region [Properties]
    protected $name = 'entity';
    #endregion

    #region [Constructor]
    /**
     * EntityFilter constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $values = array_map(function ($item) {
            return CorrelationTypeHelper::getGraphTypeByClass($item);
        }, $values);

        parent::__construct($values);
    }
    #endregion
}