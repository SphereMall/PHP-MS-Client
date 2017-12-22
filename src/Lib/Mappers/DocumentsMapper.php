<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Document;

/**
 * Class DocumentsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class DocumentsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     * @return Document
     */
    protected function doCreateObject(array $array)
    {
        $document = new Document($array);

        if (isset($array['attributes'])) {
            $document->attributes = [];

            $mapper = new AttributesMapper();
            foreach ($array['attributes'] as $attribute) {
                $document->attributes[] = $mapper->createObject($attribute);
            }
        }

        if (isset($array['functionalNames'][0])) {
            $mapper = new FunctionalNamesMapper();
            $document->functionalName = $mapper->createObject($array['functionalNames'][0]);

        }

        return $document;
    }
    #endregion
}