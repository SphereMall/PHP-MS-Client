<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 2:16 PM
 */

namespace SphereMall\MS\Lib;

use Iterator;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Lib\Http\Meta;

/**
 * @property int $total
 * @property array $objects
 * @property Meta $meta
 * @property int $pointer
 */
class Collection implements Iterator
{
    #region [Properties]
    protected $total = 0;
    protected $objects = [];
    protected $meta;

    private $pointer = 0;
    #endregion

    #region [Constructor]
    /**
     * @param array|null $objects
     * @param Meta|null $meta
     */
    function __construct(array $objects = null, Meta $meta = null)
    {
        if (!is_null($objects)) {
            $this->objects = $objects;
            $this->total = count($objects);
        }

        $this->meta = $meta ?? new Meta();
    }

    #endregion

    #region [Public methods]
    /**
     * @param $object
     * @param $id
     */
    public function add($object, $id = null)
    {
        $this->objects[($id) ?: $this->total] = $object;
        $this->total++;
    }

    /**
     * @param int $index
     * @return array
     */
    public function getByIndex(int $index)
    {
        return $this->getRow($index);
    }

    /**
     * Get current total of items in Collection
     * @return int
     */
    public function count()
    {
        return $this->total;
    }

    /**
     * @return array
     */
    public function asArray()
    {
        //TODO: Iterate with other approach
        foreach ($this as $item) {
        }
        return $this->objects;
    }

    /**
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }
    #endregion

    #region [Protected methods]
    /**
     * @param $index
     * @return null or found object
     */
    protected function getRow($index)
    {
        if (isset($this->objects[$index])) {
            return $this->objects[$index];
        }

        return null;
    }

    #endregion

    #region [Implemented methods]
    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->getRow($this->pointer);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $row = $this->getRow($this->pointer);
        if (!is_null($row)) {
            $this->pointer++;
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        $isValid = (!is_null($this->current()));
        if (!$isValid) {
            $this->pointer = 0;
        }

        return $isValid;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->pointer = 0;
    }
    #endregion
}