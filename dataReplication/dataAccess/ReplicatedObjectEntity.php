<?php
namespace entityfx\utils\dataReplication\dataAccess;

class ReplicatedObjectEntity extends ActiveRecord {
    public static function tableName() {
        return 'Utils_ReplicatedObject';
    }
}