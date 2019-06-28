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
 * @property string $title
 * @property int $langId
 * @property string $langCode
 * @property int $masterPageId
 * @property string $defaultUrl
 * @property int $active
 * @property int $orderNumber
 */
class WebSiteLanguage extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $langId;
    public $langCode;
    public $masterPageId;
    public $defaultUrl;
    public $active;
    public $orderNumber;
    #endregion
}