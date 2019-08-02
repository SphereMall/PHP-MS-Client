<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 11.03.2019
 * Time: 11:50
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Entities\EntityGroup;
use SphereMall\MS\Entities\Media;
use SphereMall\MS\Lib\Mappers\Traits\AttributesSetter;

/**
 * Class EntityGroupsMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 *
 * @property EntityGroup $entity
 * @property array       $data
 */
class EntityGroupsMapper extends Mapper
{
    use AttributesSetter;

    private $data        = [];
    private $entity = null;

    /**
     * @param array $array
     *
     * @return mixed
     */
    protected function doCreateObject(array $array)
    {
        $this->data        = $array;
        $this->entity = new EntityGroup($this->data);
        $this->setMedia()
             ->setAttributes();

        return $this->entity;
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

        $this->entity->media = $result;

        return $this;
    }
}
