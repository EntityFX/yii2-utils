<?php

namespace entityfx\utils\dataReplication\contracts\repositories;

use entityfx\utils\dataReplication\contracts\ReplicatedObject;

interface ReplicatedObjectRepositoryInterface {
    /**
     * Создаёт выгруженный объект в списке выгрузок
     *
     * @param ReplicatedObject $updatedObject Выгружаемый объект
     *
     * @return
     */
    public function create(ReplicatedObject $updatedObject);

    /**
     * Получить список выгруженных объектов для текущей выгрузки
     *
     * @param $updateHistoryId Id выгрузки
     *
     * @return ReplicatedObject[]
     */
    public function findByUpdateHistoryId($updateHistoryId);
}