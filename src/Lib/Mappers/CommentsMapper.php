<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 31.08.2018
 * Time: 16:29
 */

namespace SphereMall\MS\Lib\Mappers;


use SphereMall\MS\Entities\Comment;

/**
 * Class CommentsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class CommentsMapper extends Mapper
{
    /**
     * @param array $array
     * @return Comment
     */
    protected function doCreateObject(array $array)
    {
        return new Comment($array);
    }
}