<?php

namespace entityfx\utils\dataReplication\implementation\mapper;

use entityfx\utils\dataReplication\contracts\ReplicatedObject;
use entityfx\utils\dataReplication\dataAccess\ReplicatedObjectEntity;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\objectHistory\ObjectHistory;
use entityfx\utils\webService\contracts\services\WebServiceEndpoint;
use yii\base\Object;
use yii\db\ActiveRecord;

class ReplicatedObjectMapper extends BusinessLogicMapperBase {

    /**
     * @param \yii\base\Object $contract
     *
     * @return ReplicatedObjectEntity
     */
    public function contractToEntity(Object $contract)
    {
        /** @var $contract ReplicatedObject */
        if (!($contract instanceof ReplicatedObject)) {
            throw new ManagerException("Wrong type of mapping contract");
        }

        $entity = new ReplicatedObjectEntity();
        $entity->id = $contract->updateId;
        $entity->success = $contract->success;
        $entity->endpointId = $contract->endpoint->id;
        $entity->objectHistoryId =  $contract->objectHistory->guid->toBinaryString();
        $entity->createDatetime = $contract->updateObjectDateTime->format(DateTime::ISO8601);
        return $entity;
    }

    /**
     * @param ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public function entityToContract(ActiveRecord $entity)
    {
        /** @var $contract ReplicatedObject */
        if (!($entity instanceof ReplicatedObjectEntity)) {
            throw new ManagerException("Wrong type of mapping entity");
        }

        $contract = new ReplicatedObject();
        $contract->updateId = $entity->id;

        $endpoint = new WebServiceEndpoint();
        $endpoint->id = $entity->endpointId;
        $contract->endpoint = $endpoint;

        $contract->objectHistory = new ObjectHistory();
        $contract->objectHistory->visibleID = $entity->objectHistoryId;
        $contract->updateObjectDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $entity->createDateTime);

        $contract->success = (bool)$entity->success;

        return $contract;
    }
}