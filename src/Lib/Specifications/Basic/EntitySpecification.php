<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 11/4/2017
 * Time: 1:24 PM
 */

namespace SphereMall\MS\Lib\Specifications\Basic;

use SphereMall\MS\Entities\Entity;

/**
 * Interface EntitySpecification
 * @package SphereMall\MS\Lib\Specifications
 */
interface EntitySpecification
{
    /**
     * @param Entity $entity
     * @return bool
     */
    public function isSatisfiedBy(Entity $entity);
}