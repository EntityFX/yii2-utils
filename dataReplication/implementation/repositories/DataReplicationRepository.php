<?php

namespace entityfx\utils\dataReplication\implementation\repositories;

use entityfx\utils\dataReplication\contracts\ReplicationHistory;
use entityfx\utils\dataReplication\contracts\repositories\DataReplicationRepositoryInterface;
use entityfx\utils\dataReplication\dataAccess\ReplicationHistoryEntity;
use entityfx\utils\dataReplication\implementation\mapper\ReplicationHistoryMapper;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\RepositoryBase;

class DataReplicationRepository extends RepositoryBase implements DataReplicationRepositoryInterface  {

    /**
     * @var ReplicationHistoryMapper
     */
    private $_mapper;

    /**
     * ObjectHistoryRepository constructor.
     */
    public function __construct(ReplicationHistoryMapper $mapper) {
        $this->_mapper = $mapper;
        parent::__construct();
    }

    /**
     * Создаёт новую выгрузку
     *
     * @param \DateTime $startDateTime
     *
     * @return ReplicationHistory Возвращает домен новой выгрузки
     */
    public function startUpdate(\DateTime $startDateTime = null)
    {
        $updateHistory = new ReplicationHistory();
        $updateHistory->startDateTime = $startDateTime === null ? new \DateTime() : $startDateTime;

        try {
            $entity = $this->_mapper->contractToEntity($updateHistory);
            $entity->save();
            $updateHistory->updateId = $this->lastInsertId();
            return $updateHistory;
        } catch(\Exception $exception) {
            throw new ManagerException("Cannot store replication history", "", "", $exception);
        }
    }

    /**
     * Изменяет дату у существующей выгрузки
     *
     * @param ReplicationHistory $updateHistory
     */
    public function updateBoundaryDateTime(ReplicationHistory $updateHistory)
    {
        $updateHistory->boundaryDateTime = new \DateTime();

        try {
            $entity = $this->_mapper->contractToEntity($updateHistory);
            $entity->setOldAttribute('id', $entity->id->toBinaryString());
            $entity->update();
        } catch(\Exception $exception) {
            throw new ManagerException("Cannot update boundary time of replication history", "", "", $exception);
        }
    }

    /**
     * Завершает существующую выгрузку
     *
     * @param ReplicationHistory $updateHistory
     *
     * @return \DateTime Дата текущей выгрузки
     */
    public function endUpdate(ReplicationHistory $updateHistory)
    {
        $updateHistory->endDateTime = new \DateTime();

        try {
            $entity = $this->_mapper->contractToEntity($updateHistory);
            $entity->setOldAttribute('id', $entity->id);
            $entity->update();
        } catch(\Exception $exception) {
            throw new ManagerException("Cannot update end time of replication history", "", "", $exception);
        }
    }

    /**
     * Получает существующую выгрузку
     *
     * @param int $updateId Id выгрузки
     *
     * @return ReplicationHistory
     */
    public function read($updateId)
    {
        $entity = ReplicationHistoryEntity::findOne(['id', $updateId]);
        return $entity != null ? $this->_mapper->entityToContract($entity) : null;
    }

    /**
     * Получает последнюю выгрузку
     *
     * @return ReplicationHistory
     */
    public function readLastUpdate()
    {
        $entity = ReplicationHistoryEntity::find()->orderBy(['id' => SORT_DESC])->limit(1)->one();
        return $entity != null ? $this->_mapper->entityToContract($entity) : null;
    }
}