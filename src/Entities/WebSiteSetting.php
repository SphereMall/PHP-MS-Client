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
 * @property int $channelId
 * @property string $name
 * @property string $value
 * @property int $visible
 */
class WebSiteSetting extends Entity
{
    #region [Properties]
    public $id;
    public $channelId;
    public $name;
    public $value;
    public $visible;
    #endregion
}