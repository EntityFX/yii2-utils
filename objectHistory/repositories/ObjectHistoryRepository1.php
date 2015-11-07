<?php

namespace entityfx\utils\objectHistory\implementation\repositories;
use entityfx\utils\objectHistory\dataAccess\ObjectHistoryEntity;
use entityfx\utils\Limit;
use entityfx\utils\Guid;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\objectHistory\implementation\mapper\ObjectHistoryMapper;
use entityfx\utils\RepositoryBase;

/**
 * Created by PhpStorm.
 * Date: 08.11.2015
 * Time: 2:19
 */
class ObjectHistoryRepository extends \entityfx\utils\RepositoryBase implements ObjectHistoryRepositoryInterface  {
    private $_mapper;

    /**
     * ObjectHistoryRepository constructor.
     */
    public function __construct(ObjectHistoryMapper $mapper) {
        $this->_mapper = $mapper;
    }

    /**
     * Добавляет информацию об изменённом объекте в репозиторий истории
     *
     * @param ObjectHistory $domainObject Информация об объекте
     *
     */
    public function add(ObjectHistory $domainObject) {
        try {
            $object = $this->getById($domainObject->guid);
            if ($object === null)  {
                $this->db->createCommand()
                    ->insert(
                        KogatooObjectHistoryTable::NAME,
                        ObjectHistoryMapper::createObjectHistoryToArray($domainObject)
                    );
            } else {
                $this->updateObject($domainObject);
            }
        }
        catch(Exception $exception) {
            Yii::error($exception->getMessage());
            throw new ManagerException("Cannot add history object", "", "", $exception);
        }
    }

    /**
     * Список изменённых объектов с заданного времени и интервалом времени
     *
     * @param DateTime $startDateTime Начальное время, с которого возвращается список изменённых объектов
     * @param DateTime $endDateTime
     *
     * @internal param \DateInterval $dateInterval Интервал времени
     *
     * @return CList|ObjectHistory[]
     */
    public function read(DateTime $startDateTime, DateTime $endDateTime) {
        // TODO: Implement read() method.
    }

    private function getById(Guid $guid) {
        $entity = ObjectHistoryEntity::find($guid->toBinaryString());
        return $entity !== null ? $this->_mapper->entityToContract($entity) : null;
    }
}