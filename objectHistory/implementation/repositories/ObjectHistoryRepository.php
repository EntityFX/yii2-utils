<?php

namespace entityfx\utils\objectHistory\implementation\repositories;
use DateTime;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
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
     * @param ObjectHistoryItem $domainObject Информация об объекте
     *
     */
    public function store(ObjectHistoryItem $domainObject) {
        try {
            $historyObjectEntity = $this->_mapper->contractToEntity($domainObject);
            $object = $this->getById($domainObject->guid);
            $dt = new DateTime();
            $historyObjectEntity->changeDateTime = $dt->format('Y-m-d H:i:s');
            if ($object === null)  {
                $historyObjectEntity->save();
            } else {
                $historyObjectEntity->setOldAttribute('id', $domainObject->guid->toBinaryString());
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
     * @return ObjectHistoryItem[]
     */
    public function read(DateTime $startDateTime, DateTime $endDateTime) {
        $retrieveQuery = ObjectHistoryEntity::find();
        $fromDateTimeFormatted = $startDateTime->format('Y-m-d H:i:s');
        $toDateTimeFormatted   = $endDateTime->format('Y-m-d H:i:s');
        $retrieveQuery                          = $retrieveQuery->where(
            ['between', 'changeDateTime', $fromDateTimeFormatted, $toDateTimeFormatted]
        );
        $retrieveResult = $retrieveQuery->all();
        $retrieveDataItems       = [];
        foreach ($retrieveResult as $item) {
            $retrieveDataItems[] = $this->_mapper->entityToContract($item);
        }
        return $retrieveDataItems;
    }

    /**
     * @param Guid $guid
     * @return ObjectHistoryItem
     */
    private function getById(Guid $guid) {
        $entity = ObjectHistoryEntity::findOne($guid->toBinaryString());
        return $entity !== null ? $this->_mapper->entityToContract($entity) : null;
    }
}