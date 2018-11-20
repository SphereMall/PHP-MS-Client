<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 19:34
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Builders\Params;


use SphereMall\MS\Lib\Filters\Interfaces\ParamFilterElementInterface;

class FunctionalNamesFilter implements ParamFilterElementInterface
{
    private $functionalNames = [];

    public function __construct(array $functionalNames)
    {
        foreach ($functionalNames as $functionalNameId) {
            $this->setFunctionalNameId($functionalNameId);
        }
    }

    public function getParams(): array
    {
        return ['functionalNames' => $this->functionalNames];
    }

    private function setFunctionalNameId (int $functionalNameId)
    {
        $this->functionalNames[] = $functionalNameId;

        return $this;
    }
}
