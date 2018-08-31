<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 31.08.2018
 * Time: 15:56
 */

namespace SphereMall\MS\Resources\Comments;

use SphereMall\MS\Resources\Resource;

class CommentsResource extends Resource
{

    /**
     * @return string
     */
    function getURI()
    {
        return "comments";
    }
}