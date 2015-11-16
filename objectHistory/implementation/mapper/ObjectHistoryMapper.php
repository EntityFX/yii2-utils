<?php

namespace entityfx\utils\objectHistory\implementation\mapper;

use DateTime;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\Guid;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use entityfx\utils\objectHistory\contracts\enums\HistoryTypeEnum;
use entityfx\utils\objectHistory\dataAccess\ObjectHistoryEntity;
use yii\db\ActiveRecord;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Гузалия
 * Date: 08.11.2015
 * Time: 1:57
 */
class ObjectHistoryMapper extends BusinessLogicMapperBase {


    /**
     * @param \yii\base\Object $contract
     *
     * @return ActiveRecord
     */
    public function contractToEntity(Object $contract) {
        /** @var $contract ObjectHistoryItem */
        if (!($contract instanceof ObjectHistoryItem)) {
            throw new ManagerException("Wrong type of mapping contract");
        }
        $objectHistory                 = new ObjectHistoryEntity();
        $objectHistory->id             = $contract->guid->toBinaryString();
        $objectHistory->category       = $contract->category;
        $objectHistory->type           = $contract->type->getValue();
        $objectHistory->changeDateTime = null;
        return $objectHistory;
    }

    /**
     * @param ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public function entityToContract(ActiveRecord $entity) {
        /** @var $contract ObjectHistoryItem */
        if (!($entity instanceof ObjectHistoryEntity)) {
            throw new ManagerException("Wrong type of mapping entity");
        }
        $objectHistory                 = new ObjectHistoryItem();
        $objectHistory->guid             = Guid::parseBinaryString($entity->id);
        $objectHistory->category       = $contract->category;
        $objectHistory->type           = new HistoryTypeEnum($contract->type);
        if ($contract->changeDateTime !== null) {
            $objectHistory->changeDateTime =
                DateTime::createFromFormat('Y-m-d H:i:s', $contract->changeDateTime) ;
        }
        return $objectHistory;
    }
}