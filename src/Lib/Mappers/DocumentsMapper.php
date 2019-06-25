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
 *
 * @property Document $document
 * @property array    $data
 */
class DocumentsMapper extends Mapper
{
    private $document;
    private $data;
    #region [Protected methods]
    /**
     * @param array $array
     *
     * @return Document
     */
    protected function doCreateObject(array $array)
    {
        $this->data = $array;
        $this->document = new Document($this->data);
        $this->setFunctionalNames()
             ->setAttributes()
             ->setMedia();

        return $this->document;
    }

    /**
     * @return $this
     */
    private function setFunctionalNames()
    {
        if (isset($this->data['functionalNames']) && $functionalName = reset($this->data['functionalNames'])) {
            $this->document->functionalName = (new FunctionalNamesMapper)->createObject($functionalName);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setAttributes()
    {
        if (isset($this->data['entityAttributeValues'])) { // detail structure
            $avs = $this->data['attributeValues'] ?? [];
            $as = $this->data['attributes'] ?? [];

            /** @var Attribute[] $attributes */
            $attributes = [];

            foreach ($avs as $av) {
                if (!isset($attributes[$av['attributeId']])) {
                    $attributes[$av['attributeId']] = new Attribute($as[$av['attributeId']]);
                }
                $attributes[$av['attributeId']]->values[$av['id']] = new AttributeValue($av);
            }
            $this->document->setAttributes($attributes);
        } else { // backward compatibility
            $this->document->attributes = [];

            $mapper = new AttributesMapper();
            $attributes = [];
            foreach ($this->data['attributes'] ?? [] as $attribute) {
                $attribute['attributeValues'] = $this->getAttributeValues($attribute, $this->data['attributeValues']);

                $attributes[] = $mapper->createObject($attribute);
            }
            $this->document->setAttributes($attributes);
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setMedia()
    {
        $result = [];
        if (isset($this->data['mediaEntities'])) {
            foreach ($this->data['mediaEntities'] ?? [] as $mediaEntity) {

                if (isset($mediaEntity['media'][0])) {

                    $media = new Media($mediaEntity['media'][0]);
                    if (!$this->document->mainMedia) {
                        $this->document->mainMedia = $media;
                    }
                    $result[$mediaEntity['id']] = $media;
                }
            }

            $this->document->media = $result;

            return $this;

        }

        if (isset($this->data['media'])) {  // old structure
            $mapper = new ImagesMapper();
            foreach ($this->data['media'] as $image) {
                $result[] = $mapper->createObject($image);
            }
            if (!empty($this->document->media[0])) {
                $this->document->mainMedia = $result[0];
            }
        }

        $this->document->media = $result;

        return $this;
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
    #endregion
}
