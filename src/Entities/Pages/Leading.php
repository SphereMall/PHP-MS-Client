<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.06.2019
 * Time: 15:38
 */

namespace SphereMall\MS\Entities\Pages;

use SphereMall\MS\Entities\Entity;

/**
 * Class Leading
 * @package SphereMall\MS\Entities
 * @property int    $id
 * @property string $title
 * @property string $codePage
 * @property string $seoKeywords
 * @property string $seoDescription
 * @property int    $templateWizard
 * @property int    $language
 * @property string $seoTitle
 * @property int    $noindex
 * @property int    $layoutContainers
 */
class Leading extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $codePage;
    public $seoKeywords;
    public $seoDescription;
    public $templateWizard;
    public $language;
    public $seoTitle;
    public $noindex;
    public $layoutContainers;
    #endregion
}