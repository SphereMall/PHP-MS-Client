<?php
/**
 * Created by PhpStorm.
 * User: YaroslavDraha
 * Date: 20.09.2018
 * Time: 16:58
 */

namespace SphereMall\MS\Entities;

/**
 * Class ElasticIndexer
 * @package SphereMall\MS\Entities
 */
class ElasticIndexer extends Entity
{
    #region [Properties]
    public $added;
    public $updated;
    public $inIndex;
    public $total;
    public $type;
    public $hash;
    #endregion
}
