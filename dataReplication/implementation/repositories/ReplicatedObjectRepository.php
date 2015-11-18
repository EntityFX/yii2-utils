<?php

namespace entityfx\utils\dataReplication\implementation\repositories;

use entityfx\utils\dataReplication\contracts\ReplicatedObject;
use entityfx\utils\dataReplication\contracts\repositories\ReplicatedObjectRepositoryInterface;
use entityfx\utils\dataReplication\implementation\mapper\ReplicatedObjectMapper;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\RepositoryBase;

class ReplicatedObjectRepository extends RepositoryBase implements ReplicatedObjectRepositoryInterface  {

    /**
     * @var ReplicatedObjectMapper
     */
    private $_mapper;

    /**
     * ObjectHistoryRepository constructor.
     */
    public function __construct(ReplicatedObjectMapper $mapper) {
        $this->_mapper = $mapper;
        parent::__construct();
    }

    /**
     * Создаёт выгруженный объект в списке выгрузок
     *
     * @param ReplicatedObject $updatedObject Выгружаемый объект
     *
     * @return
     */
    public function create(ReplicatedObject $updatedObject)
    {
        try {
            $entity = $this->_mapper->contractToEntity($updatedObject);
            $entity->save();
            return $updatedObject;
        } catch(\Exception $exception) {
            throw new ManagerException("Cannot store replicated object data", "", "", $exception);
        }
    }

    /**
     * Получить список выгруженных объектов для текущей выгрузки
     *
     * @param $updateHistoryId Id выгрузки
     *
     * @return ReplicatedObject[]
     */
    public function findByUpdateHistoryId($updateHistoryId)
    {
        // TODO: Implement findByUpdateHistoryId() method.
    }
}