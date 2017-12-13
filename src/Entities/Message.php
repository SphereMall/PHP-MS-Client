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
 * Class Brand
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $senderId
 * @property int $recipientId
 * @property string $subject
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $address
 * @property string $postcode
 * @property string $message
 * @property string $date
 * @property int $accepted
 */
class Message extends Entity
{
    #region [Properties]
    public $id;
    public $senderId;
    public $recipientId;
    public $subject;
    public $name;
    public $surname;
    public $email;
    public $address;
    public $postcode;
    public $message;
    public $date;
    public $accepted;
    #endregion
}