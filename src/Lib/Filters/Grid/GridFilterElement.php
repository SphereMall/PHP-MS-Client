<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 12/2/2017
 * Time: 3:06 PM
 */

namespace SphereMall\MS\Lib\Filters\Grid;

/**
 * Class GridFilterElement
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 * @property array $values
 */
class GridFilterElement
{
    #region [Properties]
    protected $name;
    protected $values;
    #endregion

    #region [Constructor]
    /**
     * GridFilterElement constructor.
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }
    #endregion

    #region [Public methods]
    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    #endregion
}