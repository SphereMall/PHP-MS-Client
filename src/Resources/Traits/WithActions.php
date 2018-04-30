<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 30.04.2018
 * Time: 16:09
 */

namespace SphereMall\MS\Resources\Traits;

/**
 * Trait WithActions
 * @package SphereMall\MS\Resources\Traits
 * @property array $includeEntities
 * @property array $excludeEntities
 */
trait WithActions
{
    protected $includeEntities;
    protected $excludeEntities;

    /**
     * @param array $entities
     * @return $this
     */
    public function includeEntities(Array $entities)
    {
        $this->includeEntities = $entities;

        return $this;
    }

    /**
     * @param array $entities
     * @return $this
     */
    public function excludeEntities(Array $entities)
    {
        $this->excludeEntities = $entities;

        return $this;
    }

    /**
     * @return array
     */
    public function getIncludeEntities()
    {
        return $this->includeEntities;
    }

    /**
     * @return array
     */
    public function getExcludeEntities()
    {
        return $this->excludeEntities;
    }

    /**
     * @param array $additionalParams
     * @return mixed
     */
    protected function getQueryParams(array $additionalParams = [])
    {
        $params = parent::getQueryParams($additionalParams);

        if (!empty($this->getIncludeEntities())) {
            $params['actions'] = implode(',', $this->getIncludeEntities());
        }

        if (!empty($this->getExcludeEntities())) {
            $params['actions'] = '-' . implode(',-', $this->getExcludeEntities());
        }

        return $params;
    }
}