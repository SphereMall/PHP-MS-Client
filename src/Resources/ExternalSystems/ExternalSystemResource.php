<?php

namespace SphereMall\MS\Resources\ExternalSystems;

use SM\system\Context;
use SphereMall\MS\Entities\Entity;
use SphereMall\MS\Resources\Resource;

/**
 * Created by PhpStorm.
 * User: Roman Sydorchuk
 * Date: 04.02.2019
 * Time: 11:13
 */

class ExternalSystemResource extends Resource
{

    #region [Override methods]
    public function getURI()
    {
        return "externalsystem";
    }
    #endregion

    #region [Public methods]
    /**
     * @param $entityCode
     * @param $object
     * @param $systemName
     * @return array|null
     */
    public function export($entityCode, $object, $systemName, $description = null)
    {
        //TODO need to refactor according to MS methods
        if (!$entityCode || !$object || !$systemName) {
            return null;
        }

        // TODO need to discuss if it`s possible to set this params as constants
        $entityId = $this->getEntityIdByCode($entityCode);
        $externalSystemId = $this->getSystemIdByName($systemName);

        $query = "INSERT INTO `fe_ExternalSystemsExport`(`entityId`, `objectId`, `externalSystemId`, `description`) 
                  VALUES ({$entityId},{$object->get('id')}, {$externalSystemId}, {$description});";

        return Context::DB()->query($query);
    }

    public function checkIfExported($entityCode, $object, $systemName)
    {
        if (!$object || !$systemName) {
            return null;
        }

        $entityId = $this->getEntityIdByCode($entityCode);
        $externalSystemId = $this->getSystemIdByName($systemName);
        $query = "SELECT FROM `fe_ExternalSystemsExport` WHERE `entityId` = {$entityId} AND `objectId` = {$object->get('id')} AND `externalSystemId` = {$externalSystemId}";
        Context::DB()->query($query);

        return Context::DB()->result ?? null;
    }

    public function getSystemIdByName($systemName)
    {
        $query = "SELECT id FROM fe_ExternalSystems WHERE `name` = '{$systemName}'";
        Context::DB()->query($query);

        return reset($result = Context::DB()->result)['id'] ?? null;
    }

    public function getEntityIdByCode($entityCode)
    {
        $query = "SELECT id FROM sm_Entities WHERE `code` = '{$entityCode}'";
        Context::DB()->query($query);

        return reset($result = Context::DB()->result)['id'] ?? null;
    }
    #endregion
}