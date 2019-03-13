<?php

namespace SphereMall\MS\Entities;

/**
 * MenuItem entity
 * @package SphereMall\MS\Entities
 */
class MenuItem extends Entity
{
    public $id;
    public $parentId;
    public $treeItemName;
    public $link;
    public $urlPath;
    public $visible;
    public $orderNumber;
    public $moduleId;
    public $imageActive;
    public $imageInactive;
    public $openLinkInNewWindow;
    public $langId;
    public $urlBaner;
    public $viewId;
    public $hideItemSettings;
    public $entityId;
    public $objectId;
    public $clickable;
    public $filterSettings;
    public $filterPanelSettings;
    public $sortingSettings;
    public $seoTitle;
    public $seoDescription;
    public $seoKeywords;
    public $lastUpdate;
    public $noindex;
    public $image;
    public $description;
    public $masterPageId;
}