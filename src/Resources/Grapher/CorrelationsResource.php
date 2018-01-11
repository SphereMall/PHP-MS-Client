<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Grapher;

use Exception;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Filters\Grid\GridFilter;
use SphereMall\MS\Lib\Helpers\ClassReflectionHelper;
use SphereMall\MS\Lib\Helpers\CorrelationTypeHelper;
use SphereMall\MS\Lib\Makers\CountMaker;
use SphereMall\MS\Lib\Makers\FacetsMaker;
use SphereMall\MS\Lib\Specifications\Basic\FilterSpecification;
use SphereMall\MS\Resources\Resource;

/**
 * Class GridResource
 * @package SphereMall\MS\Resources\Users
 */
class CorrelationsResource extends GrapherResource
{
    #region [Override methods]
    public function getURI()
    {
        return "correlations";
    }
    #endregion

    #region [Override methods]
    /**
     * @param int $id
     * @param string $forClassName
     * @return array|Collection
     */
    public function getById(int $id, string $forClassName)
    {
        $params = $this->getQueryParams();

        $type = CorrelationTypeHelper::getGraphTypeByClass($forClassName);
        $uriAppend = "{$type}/{$id}";

        $response = $this->handler->handle('GET', false, $uriAppend, $params);
        return $this->make($response);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with correlations");
    }

    /**
     * @param $id
     * @param $data
     * @throws Exception
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with correlations");
    }

    /**
     * @param $data
     * @throws Exception
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with correlations");
    }

    /**
     * @param $id
     * @return bool|void
     * @throws Exception
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with correlations");
    }
    #endregion
}