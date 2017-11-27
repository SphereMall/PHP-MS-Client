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
 * Class Invoice
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $invoiceHash
 * @property string $path
 * @property string $createDate
 * @property int $orderId
 */
class Invoice extends Entity
{
    #region [Properties]
    public $id;
    public $invoiceHash;
    public $path;
    public $createDate;
    public $orderId;
    #endregion
}