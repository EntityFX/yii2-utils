<?php

namespace entityfx\utils\objectHistory\implementation\mapper;
use DateTime;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\objectHistory\contracts\ObjectHistory;
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
    public function contractToEntity(Object $contract)
    {
        /** @var $contract ObjectHistory */
        if (!($contract instanceof ObjectHistory)) {
            throw new ManagerException("Wrong type of mapping contract");
        }
        $objectHistory            = new ObjectHistoryEntity();
        $objectHistory->id      = $contract->guid->toBinaryString();
        $objectHistory->category  = $contract->category;
        $objectHistory->type      = $contract->type->getValue();
        $objectHistory->changeDateTime = null;
        $objectHistory->priority = $contract->priority;
        return $objectHistory;
    }

    /**
     * @param ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public function entityToContract(ActiveRecord $entity)
    {
        // TODO: Implement entityToContract() method.
    }
}