<?php
namespace entityfx\utils\dataReplication\dataAccess;

use yii\db\ActiveRecord;

class ReplicationHistoryEntity extends ActiveRecord {
    public static function tableName() {
        return 'Utils_ReplicationHistory';
    }
}