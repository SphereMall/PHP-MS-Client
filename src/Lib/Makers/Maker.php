<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/21/2017
 * Time: 5:26 PM
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\Response;

interface Maker
{
    /**
     * @param Response $response
     * @return mixed|Collection
     */
    function make(Response $response);
}