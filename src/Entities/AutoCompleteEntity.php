<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.03.2018
 * Time: 9:53
 */

namespace SphereMall\MS\Entities;

/**
 * Class AutoCompleteEntity
 * @package SphereMall\MS\Entities
 *
 * @property int    $id
 * @property string $title
 * @property string $urlCode
 */
abstract class AutoCompleteEntity extends Entity
{
    public $id;
    public $title;
    public $urlCode;
}