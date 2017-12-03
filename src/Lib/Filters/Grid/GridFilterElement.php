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
 * @property int $level
 */
class GridFilterElement
{
    #region [Properties]
    protected $name;
    protected $values = [];
    protected $level = 0;
    #endregion

    #region [Public methods]
    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param int|string|array $value
     * @return $this
     */
    public function value($value)
    {
        if (is_array($value)) {
            $this->values[$this->level] = array_merge($this->values[$this->level] ?? [], $value);
            return $this;
        }

        $this->values[$this->level][] = $value;
        return $this;
    }

    /**
     * @param int|string|array $value
     * @return $this
     */
    public function andValue($value)
    {
        return $this->value($value);
    }

    /**
     * @param $value
     * @return $this
     */
    public function orValue($value)
    {
        $this->level++;
        return $this->value($value);
    }

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