<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 29.06.15
 * Time: 2:10
 * To change this template use File | Settings | File Templates.
 */

namespace entityfx\utils\mappers;


use yii\base\Object;
use yii\db\ActiveRecord;

abstract class BusinessLogicMapperBase extends Object {
    /**
     * @param \yii\base\Object $contract
     *
     * @return ActiveRecord
     */
    public abstract function contractToEntity(Object $contract);

    /**
     * @param ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public abstract function entityToContract(ActiveRecord $entity);
}