<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class Entity
 * @package SphereMall\MS\Entities
 */
class Entity
{
    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (empty($data)) {
            return $this;
        }

        foreach ($data as $optionKey => $optionValue) {
            if (property_exists($this, $optionKey)) {
                $this->{$optionKey} = $optionValue;
            }
        }

        return $this;
    }

    public function asArray()
    {
        return get_object_vars($this);
    }
}