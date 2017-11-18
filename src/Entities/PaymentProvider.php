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
 * Class OrderStatus
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property string $title
 * @property string $className
 * @property string $msUrl
 * @property string $merchantId
 * @property string $postUrl
 * @property string $secretKey
 * @property string $keyVersion
 * @property string $apiKey
 * @property string $shaIn
 * @property string $shaOut
 * @property string $autoReturnUrl
 * @property string $returnUrl
 */
class PaymentProvider extends Entity
{
    #region [Properties]
    public $id;
    public $title;
    public $className;
    public $msUrl;
    public $merchantId;
    public $postUrl;
    public $secretKey;
    public $keyVersion;
    public $apiKey;
    public $shaIn;
    public $shaOut;
    public $autoReturnUrl;
    public $returnUrl;
    #endregion
}