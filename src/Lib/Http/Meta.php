<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/25/2017
 * Time: 6:27 PM
 */

namespace SphereMall\MS\Lib\Http;

/**
 * Class Meta
 * @package SphereMall\MS\Lib\Http
 * @property int $count
 * @property int $limit
 * @property int $offset
 */
class Meta
{
    #region [Properties]
    public $count;
    public $limit;
    public $offset;
    #endregion

    #region [Constructor]
    /**
     * Meta constructor.
     * @param $count
     * @param $limit
     * @param $offset
     */
    public function __construct($count = 0, $limit = 0, $offset = 0)
    {
        $this->count = $count;
        $this->limit = $limit;
        $this->offset = $offset;
    }
    #endregion
}