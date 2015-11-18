<?php

namespace entityfx\utils\dataReplication\implementation;

use entityfx\utils\dataReplication\contracts\DataReplicationManagerInterface;
use entityfx\utils\dataReplication\contracts\ReplicatedObject;
use entityfx\utils\dataReplication\contracts\ReplicationContext;
use entityfx\utils\dataReplication\contracts\repositories\DataReplicationRepositoryInterface;
use entityfx\utils\dataReplication\contracts\repositories\ReplicatedObjectRepositoryInterface;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\ManagerBase;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use entityfx\utils\objectHistory\contracts\repositories\ObjectHistoryRepositoryInterface;
use entityfx\utils\webService\contracts\services\WebServiceEndpoint;
use Yii;
use yii\log\Logger;

class DataReplicationManager extends ManagerBase implements  DataReplicationManagerInterface  {

    /**
     * @var ReplicationContext
     */
    private $_updateContext;

    /**
     * @var DataReplicationRepositoryInterface
     */
    private $_dataReplicationRepository;

    /**
     * @var ReplicatedObjectRepositoryInterface
     */
    private $_replicatedObjectRepository;

    /**
     * @var ObjectHistoryRepositoryInterface
     */
    private $_objectHistoryRepository;

    function __construct(
        DataReplicationRepositoryInterface $_dataReplicationRepository,
        ReplicatedObjectRepositoryInterface$_replicatedObjectRepository,
        ObjectHistoryRepositoryInterface $_objectHistoryRepository)
    {
        $this->_dataReplicationRepository = $_dataReplicationRepository;
        $this->_replicatedObjectRepository = $_replicatedObjectRepository;
        $this->_objectHistoryRepository = $_objectHistoryRepository;
        parent::__construct();
    }

    /**
     * @return ReplicationContext
     */
    public function beginUpdate()
    {
        $initialDateTime = new \DateTime();
        $beginObjectsDateTime = new \DateTime('1970-01-01');
        $lastUpdate = $this->_dataReplicationRepository->readLastUpdate();

        if ($lastUpdate !== null) {
            if ($lastUpdate->endDateTime === null) {
                $lastUpdate->endDateTime = $initialDateTime;
                $this->_dataReplicationRepository->endUpdate($lastUpdate);
                if ($lastUpdate->boundaryDateTime !== null) {
                    $beginObjectsDateTime = clone $lastUpdate->boundaryDateTime;
                } else {
                    $beginObjectsDateTime = clone $lastUpdate->startDateTime;
                }
            } else {
                $beginObjectsDateTime = clone $lastUpdate->endDateTime;
            }
        }

        $beginObjectsDateTimeString = $beginObjectsDateTime->format('Y-m-d H:i:s');
        $endObjectsDateTimeString = $initialDateTime->format('Y-m-d H:i:s');
        Yii::info("UpdateService::beginUpdate() - Read history objects by date from $beginObjectsDateTimeString to $endObjectsDateTimeString", Logger::LEVEL_INFO, self::SERVICE_CATEGORY);

        $objectsToUpdate = $this->_objectHistoryRepository->read($beginObjectsDateTime, $initialDateTime);

        $currentUpdate = $this->_dataReplicationRepository->startUpdate($initialDateTime);

        $this->_updateContext = new ReplicationContext();
        $this->_updateContext->currentUpdate = $currentUpdate;
        $this->_updateContext->objectsToUpdate = $objectsToUpdate;

        return $this->_updateContext;
    }

    public function successUpdateObject(ObjectHistoryItem $updatingObject, WebServiceEndpoint $endpoint)
    {
        $this->commitUpdateObject($updatingObject, $endpoint, true);
    }

    public function failUpdateObject(ObjectHistoryItem $updatingObject, WebServiceEndpoint $endpoint)
    {
        $this->commitUpdateObject($updatingObject, $endpoint, false);
    }

    public function endUpdate()
    {
        $this->isUpdateStartedOrExcept();

        $this->_dataReplicationRepository->endUpdate($this->_updateContext->currentUpdate);
        $this->_updateContext = null;
    }

    /**
     * @param ObjectHistoryItem      $updatingObject
     * @param WebServiceEndpoint $endpoint
     * @param bool               $status
     */
    private function commitUpdateObject(ObjectHistoryItem $updatingObject, WebServiceEndpoint $endpoint, $status) {
        $this->isUpdateStartedOrExcept();

        $updatedObject = new ReplicatedObject();
        $updatedObject->endpoint = $endpoint;
        $updatedObject->objectHistory = $updatingObject;
        $updatedObject->updateId = $this->_updateContext->currentUpdate->updateId;
        $updatedObject->success = (bool)$status;
        $this->_replicatedObjectRepository->create($updatedObject);

        $this->_dataReplicationRepository->updateBoundaryDateTime($this->_updateContext->currentUpdate);
    }

    private function isUpdateStartedOrExcept() {
        if ($this->_updateContext === null) {
            throw new ManagerException("Update is not started");
        }
    }

}