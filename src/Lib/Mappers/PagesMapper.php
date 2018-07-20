<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:08
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Page;

/**
 * Class PagesMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class PagesMapper extends Mapper
{
    /**
     * @param array $array
     * @return Page
     */
    protected function doCreateObject(array $array)
    {
        $page = new Page($array);
        if (isset($array['functionalNames']) && $functionalName = reset($array['functionalNames'])) {
            $mapper               = new FunctionalNamesMapper();
            $page->functionalName = $mapper->createObject($functionalName);
        }

        return $page;
    }
}
