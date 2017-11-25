<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class CatalogItem
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $parentId
 * @property string $treeItemName
 * @property string $urlCode
 * @property int $visible
 * @property int $orderNumber
 * @property int $openLinkInNewWindow
 * @property array $filterSettings
 * @property int $moduleId
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeywords
 * @property string $lastUpdate
 * @property int $noindex
 * @property int $clickable
 * @property array $hideItemSettings
 */
class CatalogItem extends Entity
{
    #region [Properties]
    public $id;
    public $parentId;
    public $treeItemName;
    public $urlCode;
    public $visible;
    public $orderNumber;
    public $openLinkInNewWindow;
    public $filterSettings;
    public $moduleId;
    public $seoTitle;
    public $seoDescription;
    public $seoKeywords;
    public $lastUpdate;
    public $noindex;
    public $clickable;
    public $hideItemSettings;
    #endregion
}