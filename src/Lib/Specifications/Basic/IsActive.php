<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:44 PM
 */

namespace SphereMall\MS\Lib\Specifications\Basic;

use InvalidArgumentException;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Lib\Filters\FilterOperators;

/**
 * Class IsActive
 * @package SphereMall\MS\Lib\Specifications\Basic
 */
class IsActive implements FilterSpecification, EntitySpecification
{
    /**
     * @return array
     */
    public function asFilter()
    {
        return ['active' => [FilterOperators::EQUAL => 1]];
    }

    /**
     * @param Entity $entity
     *
     * @return bool
     */
    public function isSatisfiedBy(Entity $entity)
    {
        if (property_exists($entity, 'active')) {
            return (bool)$entity->active;
        }

        throw new InvalidArgumentException("Property 'active' does not exist in class " . get_class($entity));
    }
}
