<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 17:45
 */

namespace SphereMall\MS\Entities;

/**
 * Class WebText
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $name
 * @property string $protocol
 * @property string $URL
 */
class WebSite extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $protocol;
    public $URL;
    #endregion
}