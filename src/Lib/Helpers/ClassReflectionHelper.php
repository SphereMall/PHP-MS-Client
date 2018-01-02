<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 1/2/2018
 * Time: 12:24 PM
 */

namespace SphereMall\MS\Lib\Helpers;

/**
 * Class ClassReflectionHelper
 * @package SphereMall\MS\Lib\Helpers
 * @property string $className
 */
class ClassReflectionHelper
{
    #region [Properties]
    protected $className;
    #endregion

    #region [Constructor]
    public function __construct(string $className)
    {
        $this->className = $className;
    }
    #endregion

    #region [Public methods]
    public function getShortName()
    {
        return (new \ReflectionClass($this->className))->getShortName();
    }

    public function getShortLowerCaseName()
    {
        return strtolower($this->getShortName());
    }
    #endregion
}