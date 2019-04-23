<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:37
 */

namespace SphereMall\MS\Entities;

use JsonSerializable;
use SphereMall\MS\Lib\BaseModel;
use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;

/**
 * Class Entity
 * @package SphereMall\MS\Entities
 */
class Entity extends BaseModel implements JsonSerializable
{
    #region [Public methods]

    /**
     * @return string
     */
    public function getType()
    {
        return (new ClassReflectionHelper(get_called_class()))->getShortLowerCaseName();
    }

    /**
     * Specify data which should be serialized to JSON.
     * Includes all public properties by default plus data from properties array.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $publicProperties = get_object_vars($this);
        unset($publicProperties['properties']);

        return array_merge($publicProperties, $this->getPropertiesField());
    }
    #endregion
}