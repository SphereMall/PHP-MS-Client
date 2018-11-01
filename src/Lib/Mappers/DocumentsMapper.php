<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Entities\Document;
use SphereMall\MS\Entities\Media;

/**
 * Class DocumentsMapper
 * @package SphereMall\MS\Lib\Mappers
 */
class DocumentsMapper extends Mapper
{
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Document
     */
    protected function doCreateObject(array $array)
    {
        $document = new Document($array);

        if (isset($array['functionalNames']) && $functionalName = reset($array['functionalNames'])) {
            $mapper                   = new FunctionalNamesMapper();
            $document->functionalName = $mapper->createObject($functionalName);

        }

        /* Customize mapping */
        $document = isset($array['entityAttributeValues'])
            ? $this->buildDetailResponse($document, $array)
            : $this->buildFullResponse($document, $array);

        return $document;
    }

    /**
     * @param $attribute
     * @param $attributeValues
     *
     * @return array
     */
    private function getAttributeValues($attribute, $attributeValues)
    {
        $values = [];
        foreach ($attributeValues as $attributeValue) {
            if ($attribute['id'] == $attributeValue['attributeId']) {
                $values[] = $attributeValue;
            }
        }

        return $values;
    }

    /**
     * map data with custom fields
     *
     * @param Document $document
     * @param array $array
     * @return Document
     */
    private function buildFullResponse(Document $document, array $array)
    {

        if (isset($array['attributes']) && isset($array['attributeValues'])) {
            $document->attributes = [];

            $mapper = new AttributesMapper();
            foreach ($array['attributes'] as $attribute) {
                $attribute['attributeValues'] = $this->getAttributeValues($attribute, $array['attributeValues']);

                $attributes = $mapper->createObject($attribute);
                $document->setAttributes($attributes);
            }
        }

        if (isset($array['media'])) {
            $media = [];
            $mapper = new ImagesMapper();
            foreach ($array['media'] as $image) {
                $media[] = $mapper->createObject($image);
            }

            $document->media = $media;

            if (!empty($document->media[0])) {
                $document->mainMedia = $document->media[0];
            }
        }

        return $document;
    }

    /**
     * map data without custom fields
     *
     * @param Document $document
     * @param array $array
     * @return Document
     */
    private function buildDetailResponse(Document $document, array $array)
    {
        $avs = $array['attributeValues'] ?? [];
        $as = $array['attributes'] ?? [];

        /** @var Attribute[] $attributes */
        $attributes = [];

        foreach ($avs as $av) {
            if (!isset($attributes[$av['attributeId']])) {
                $attributes[$av['attributeId']] = new Attribute($as[$av['attributeId']]);
            }
            $attributes[$av['attributeId']]->values[$av['id']] = new AttributeValue($av);
        }

        $document->setAttributes($attributes);

        $me = $array['mediaEntities'] ?? [];
        $m = $array['media'] ?? [];

        /** @var Media[] $media */
        $media = [];

        foreach ($me as $item) {
            $media[$item['id']] = new Media(array_merge($m[$item['mediaId']], $item));
        }

        $document->media = $media;

        if (!empty($document->media[0])) {
            $document->mainMedia = $document->media[0];
        }

        return $document;
    }
    #endregion
}
