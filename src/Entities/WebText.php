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
 * @property string $keyword
 * @property string $description
 * @property int $channelId
 * @property string $langCode
 * @property int $langId
 */
class WebText extends Entity
{
    #region [Properties]
    public $id;
    public $keyword;
    public $description;
    public $channelId;
    public $langCode;
    public $langId;
    #endregion
}