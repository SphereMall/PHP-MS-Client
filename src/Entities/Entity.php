<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;
use SphereMall\MS\Lib\Traits\InteractsWithProperties;

/**
 * Class Entity
 * @package SphereMall\MS\Entities
 */
class Entity
{
    use InteractsWithProperties;

    #region [Constructor]

    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (empty($data)) {
            return $this;
        }

        $this->setPropertyList($data);

        return $this;
    }
    #endregion

    #region [Public methods]

    /**
     * @return array
     */
    public function asArray()
    {
        $properties = [];
        foreach ($this as $key => $value) {
            if ($key == 'properties') {
                continue;
            }
            $properties[$key] = $value;
        }

        return array_merge($properties, $this->properties);
    }

    public function getType()
    {
        return (new ClassReflectionHelper(get_called_class()))->getShortLowerCaseName();
    }
    #endregion
}