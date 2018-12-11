<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 11.12.18
 * Time: 17:31
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

class ProductGroupsFilter extends BasicQueryBuilder implements ParamFilterElementInterface
{
    private   $productGroups = [];
    protected $fieldName     = 'productGroupsIds';

    /**
     * ProductGroupsFilter constructor.
     *
     * @param array $productGroups
     */
    public function __construct(array $productGroups)
    {
        foreach ($productGroups as $productGroup) {
            $this->setProductGroupsId($productGroup);
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return ['productGroups' => $this->productGroups];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->productGroups;
    }

    /**
     * @param int $productGroupsId
     *
     * @return $this
     */
    private function setProductGroupsId(int $productGroupsId)
    {
        $this->productGroups[] = $productGroupsId;

        return $this;
    }
}
