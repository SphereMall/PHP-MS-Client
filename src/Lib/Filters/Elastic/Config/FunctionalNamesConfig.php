<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 20.11.18
 * Time: 13:40
 */

namespace SphereMall\MS\Lib\Filters\Elastic\Config;

use SphereMall\MS\Lib\Filters\Interfaces\ElasticConfigInterface;

class FunctionalNamesConfig implements ElasticConfigInterface
{
    private $use = false;

    public function __construct(bool $use)
    {
        $this->use = $use;
    }

    /**
     * @return mixed
     */
    public function getElements(): array
    {
        return [
            'functionalNames' => $this->use,
        ];
    }
}
