<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:02
 */

namespace SphereMall\MS\Entities;

/**
 * Class Page
 * @package SphereMall\MS\Entities
 *
 * @property int            $id
 * @property string         $urlCode
 * @property string         $seoTitle
 * @property string         $seoDescription
 * @property string         $seoKeywords
 * @property int            $visible
 * @property string         $introHtml
 * @property string         $outroHtml
 * @property string         $title
 * @property string         $html
 * @property string         $shortDescription
 * @property string         $dateStartVisible
 * @property string         $dateEndVisible
 * @property string         $lastUpdate
 * @property int            $noindex
 * @property FunctionalName $functionalName
 */
class Page extends AutoCompleteEntity
{
    #region [Properties]
    public $seoTitle;
    public $seoDescription;
    public $seoKeywords;
    public $visible;
    public $introHtml;
    public $outroHtml;
    public $html;
    public $shortDescription;
    public $dateStartVisible;
    public $dateEndVisible;
    public $lastUpdate;
    public $noindex;

    public $functionalName;
    #endregion
}
