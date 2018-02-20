<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:45
 */

namespace SphereMall\MS\Lib\Filters\Grid;

/**
 * Class ElasticSearchFilterElement
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 * @property array  $values
 */
class ElasticSearchFilterElement
{
    #region [Properties]
    protected $name;
    protected $values;
    #endregion

    #region [Constructor]
    /**
     * ElasticSearchFilterElement constructor.
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    #endregion
}
