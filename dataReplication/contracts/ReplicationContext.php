<?php

namespace entityfx\utils\dataReplication\contracts;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use yii\base\Object;

/**
 * Class ReplicationContext
 *
 * @author EntityFX <artem.solopiy@gmail.com>
 * @property ReplicationHistory         $currentUpdate
 * @property ObjectHistoryItem[] $objectsToUpdate
 */
class ReplicationContext extends Object {
    /**
     * @var ReplicationHistory
     */
    private $_currentUpdate;
    /**
     * @var ObjectHistoryItem[]
     */
    private $_objectsToUpdate;

    /**
     * @return ReplicationHistory
     */
    public function getCurrentUpdate() {
        return $this->_currentUpdate;
    }

    /**
     * @param ReplicationHistory $currentUpdate
     */
    public function setCurrentUpdate(ReplicationHistory $currentUpdate) {
        $this->_currentUpdate = $currentUpdate;
    }

    public function getObjectsToUpdate() {
        return $this->_objectsToUpdate;
    }

    public function setObjectsToUpdate(array $objectsToUpdate) {
        $this->_objectsToUpdate = $objectsToUpdate;
    }
}
