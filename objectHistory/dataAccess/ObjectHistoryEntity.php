<?php

namespace entityfx\utils\objectHistory\dataAccess;
use yii\db\ActiveRecord;

/**
 * Created by PhpStorm.
 * User: Гузалия
 * Date: 08.11.2015
 * Time: 1:54
 */
class ObjectHistoryEntity extends ActiveRecord {
    public static function tableName() {
        return 'ObjectHistory';
    }
}