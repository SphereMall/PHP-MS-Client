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
 * @property int $masterPageId
 * @property WebSiteSetting[] $settings
 * @property WebSiteLanguage[] $languages
 */
class WebSite extends Entity
{
    #region [Properties]
    public $id;
    public $name;
    public $protocol;
    public $URL;
    public $masterPageId;
    public $settings;
    public $languages;
    #endregion
}