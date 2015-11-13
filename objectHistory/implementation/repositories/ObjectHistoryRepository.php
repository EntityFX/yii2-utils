<?php

namespace entityfx\utils\objectHistory\implementation\repositories;
use DateTime;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\objectHistory\contracts\ObjectHistory;
use entityfx\utils\objectHistory\contracts\repositories\ObjectHistoryRepositoryInterface;
use entityfx\utils\objectHistory\dataAccess\ObjectHistoryEntity;
use entityfx\utils\Guid;
use entityfx\utils\objectHistory\implementation\mapper\ObjectHistoryMapper;
use entityfx\utils\RepositoryBase;
use Yii;
use yii\db\IntegrityException;

/**
 * Created by PhpStorm.
 * Date: 08.11.2015
 * Time: 2:19
 */
class ObjectHistoryRepository extends RepositoryBase implements ObjectHistoryRepositoryInterface  {
    /**
     * @var ObjectHistoryMapper
     */
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
    public function store(ObjectHistory $domainObject) {
        try {
            $historyObjectEntity = $this->_mapper->contractToEntity($domainObject);
            $object = $this->getById($domainObject->guid);
            $dt = new DateTime();
            $historyObjectEntity->changeDateTime = $dt->format('Y-m-d H:i:s');
            if ($object === null)  {
                $historyObjectEntity->save();
            } else {
                $historyObjectEntity->setOldAttribute('id', $object->id->toBinaryString());
                $historyObjectEntity->update();
            }
        } catch (IntegrityException $integrityException) {
            Yii::error($integrityException->getMessage());
            throw new ManagerException("Cannot create sensor", "", "", $integrityException);
        }
    }

    /**
     * Список изменённых объектов с заданного времени и интервалом времени
     *
     * @param DateTime $startDateTime Начальное время, с которого возвращается список изменённых объектов
     * @param DateTime $endDateTime
     *
     *
     * @return ObjectHistory[]
     */
    public function read(DateTime $startDateTime, DateTime $endDateTime) {
        $retrieveQuery = ObjectHistoryEntity::find();
        $fromDateTimeFormatted = $startDateTime->format('Y-m-d H:i:s');
        $toDateTimeFormatted   = $endDateTime->format('Y-m-d H:i:s');
        $retrieveQuery                          = $retrieveQuery->where(
            ['between', 'changeDateTime', $fromDateTimeFormatted, $toDateTimeFormatted]
        );
        var_dump($retrieveQuery->all());
    }

    private function update(ObjectHistory $domainObject) {
        $this->db->createCommand()
            ->update(
                KogatooObjectHistoryTable::NAME,
                ObjectHistoryMapper::updateObjectHistoryToArray($domainObject),
                KogatooObjectHistoryTable::GUID_FIELD . ' = :guid',
                array(
                    ':guid' => $domainObject->guid->value
                )
            );
    }

    /**
     * @param Guid $guid
     * @return ObjectHistory
     */
    private function getById(Guid $guid) {
        $entity = ObjectHistoryEntity::findOne($guid->toBinaryString());
        return $entity !== null ? $this->_mapper->entityToContract($entity) : null;
    }
}