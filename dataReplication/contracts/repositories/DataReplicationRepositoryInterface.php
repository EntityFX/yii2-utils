<?php

namespace entityfx\utils\dataReplication\contracts\repositories;

use entityfx\utils\dataReplication\contracts\ReplicationHistory;

interface DataReplicationRepositoryInterface {

    const FAULT_CANT_CREATE              = 1;
    const FAULT_CANT_UPDATE_BOUNDARY     = 2;
    const FAULT_CANT_UPDATE_END_DATETIME = 3;

    /**
     * Создаёт новую выгрузку
     *
     * @param \DateTime $startDateTime
     *
     * @return ReplicationHistory Возвращает домен новой выгрузки
     */
    public function startUpdate(\DateTime $startDateTime = null);

    /**
     * Изменяет дату у существующей выгрузки
     *
     * @param ReplicationHistory $updateHistory
     */
    public function updateBoundaryDateTime(ReplicationHistory $updateHistory);

    /**
     * Завершает существующую выгрузку
     *
     * @param ReplicationHistory $updateHistory
     *
     * @return \DateTime Дата текущей выгрузки
     */
    public function endUpdate(ReplicationHistory $updateHistory);

    /**
     * Получает существующую выгрузку
     *
     * @param int $updateId Id выгрузки
     *
     * @return ReplicationHistory
     */
    public function read($updateId);

    /**
     * Получает последнюю выгрузку
     *
     * @return ReplicationHistory
     */
    public function readLastUpdate();
}