<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.15
 * Time: 17:11
 */

namespace entityfx\utils\dataReplication\implementation\mapper;


use entityfx\utils\dataReplication\contracts\ReplicationHistory;
use entityfx\utils\dataReplication\dataAccess\ReplicationHistoryEntity;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use yii\base\Object;
use yii\db\ActiveRecord;

class ReplicationHistoryMapper extends BusinessLogicMapperBase {

    /**
     * @param \yii\base\Object $contract
     *
     * @return ActiveRecord
     */
    public function contractToEntity(Object $contract)
    {
        /** @var $contract ReplicationHistory */
        if (!($contract instanceof ReplicationHistory)) {
            throw new ManagerException("Wrong type of mapping contract");
        }

        $entity = new ReplicationHistoryEntity();
        $entity->id = $contract->updateId;
        $entity->startDatetime = $contract->startDateTime->format(\DateTime::ISO8601);

        if ($contract->boundaryDateTime !== null) {
            $entity->boundaryDatetime = $contract->boundaryDateTime->format(\DateTime::ISO8601);
        }

        if ($contract->endDateTime !== null) {
            $entity->endDatetime = $contract->endDateTime->format(\DateTime::ISO8601);
        }
        return $entity;
    }

    /**
     * @param ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public function entityToContract(ActiveRecord $entity)
    {
        /** @var $contract ReplicationHistoryEntity */
        if (!($entity instanceof ReplicationHistoryEntity)) {
            throw new ManagerException("Wrong type of mapping entity");
        }

        $contract = new ReplicationHistory();
        $contract->updateId = (int)$entity->id;
        $contract->startDatetime = \DateTime::createFromFormat('Y-m-d H:i:s', $entity->startDatetime);

        if ($entity->boundaryDatetime !== null) {
            $contract->boundaryDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $entity->boundaryDatetime);
        }

        if ($entity->boundaryDatetime !== null) {
            $contract->endDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $entity->endDatetime);
        }

        return $contract;
    }
}