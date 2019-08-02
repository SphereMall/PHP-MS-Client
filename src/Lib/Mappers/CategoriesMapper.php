<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 11.03.2019
 * Time: 09:48
 */

namespace SphereMall\MS\Lib\Mappers;

use SphereMall\MS\Entities\Attribute;
use SphereMall\MS\Entities\AttributeValue;
use SphereMall\MS\Entities\Category;
use SphereMall\MS\Entities\Media;
use SphereMall\MS\Lib\Mappers\Traits\AttributesSetter;

/**
 * Class CategoriesMapper
 *
 * @package SphereMall\MS\Lib\Mappers
 *
 * @property Category $entity
 * @property array    $data
 */
class CategoriesMapper extends Mapper
{
    use AttributesSetter;

    private $data     = [];
    private $entity = null;

    /**
     * @param array $array
     *
     * @return Category
     */
    protected function doCreateObject(array $array)
    {
        $this->data     = $array;
        $this->entity = new Category($this->data);
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
