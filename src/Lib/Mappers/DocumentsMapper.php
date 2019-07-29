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
use SphereMall\MS\Lib\Mappers\Traits\AttributesSetter;

/**
 * Class DocumentsMapper
 * @package SphereMall\MS\Lib\Mappers
 *
 * @property Document $entity
 * @property array    $data
 */
class DocumentsMapper extends Mapper
{
    use AttributesSetter;

    private $entity;
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
        $this->entity = new Document($this->data);
        $this->setFunctionalNames()
             ->setAttributes()
             ->setMedia();

        return $this->entity;
    }

    /**
     * @return $this
     */
    private function setFunctionalNames()
    {
        if (isset($this->data['functionalNames']) && $functionalName = reset($this->data['functionalNames'])) {
            $this->entity->functionalName = (new FunctionalNamesMapper)->createObject($functionalName);
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
                    if (!$this->entity->mainMedia) {
                        $this->entity->mainMedia = $media;
                    }
                    $result[$mediaEntity['id']] = $media;
                }
            }

            $this->entity->media = $result;

            return $this;

        }

        if (isset($this->data['media'])) {  // old structure
            $mapper = new ImagesMapper();
            foreach ($this->data['media'] as $image) {
                $result[] = $mapper->createObject($image);
            }
            if (!empty($this->entity->media[0])) {
                $this->entity->mainMedia = $result[0];
            }
        }

        $this->entity->media = $result;

        return $this;
    }
    #endregion
}
