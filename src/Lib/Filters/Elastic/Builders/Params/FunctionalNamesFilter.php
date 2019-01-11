<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:34
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;

use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

/**
 * Class FunctionalNamesFilter
 *
 * @package SphereMall\MS\Lib\Filters\Elastic\Builders\Params
 */
class FunctionalNamesFilter extends BasicQueryBuilder implements ParamFilterElementInterface
{
    private   $functionalNames = [];
    protected $fieldName       = 'functionalNameId';

    /**
     * FunctionalNamesFilter constructor.
     *
     * @param array $functionalNames
     */
    public function __construct(array $functionalNames)
    {
        foreach ($functionalNames as $functionalNameId) {
            $this->setFunctionalNameId($functionalNameId);
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return ['functionalNames' => $this->functionalNames];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->functionalNames;
    }

    /**
     * @param int $functionalNameId
     *
     * @return $this
     */
    private function setFunctionalNameId(int $functionalNameId)
    {
        $this->functionalNames[] = $functionalNameId;

        return $this;
    }
}
