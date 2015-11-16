<?php

namespace entityfx\utils\objectHistory\implementation;

use entityfx\utils\ManagerBase;
use entityfx\utils\objectHistory\contracts\enums\HistoryTypeEnum;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use entityfx\utils\objectHistory\contracts\ObjectHistoryManagerInterface;
use entityfx\utils\objectHistory\contracts\repositories\ObjectHistoryRepositoryInterface;
use entityfx\utils\objectHistory\dataAccess\ObjectHistoryEntity;
use entityfx\utils\objectHistory\implementation\repositories\ObjectHistoryRepository;


class ObjectHistoryManager extends ManagerBase implements  ObjectHistoryManagerInterface  {

    /**
     * @var ObjectHistoryRepositoryInterface
     */
    private $_objectHistoryRepository;


    /**
     * @param ObjectHistoryRepositoryInterface $objectHistoryRepository
     */
    public function __construct(ObjectHistoryRepositoryInterface $objectHistoryRepository) {
        $this->_objectHistoryRepository = $objectHistoryRepository;
        parent::__construct();
    }


    function objectModified(HistoryTypeEnum $type, $giud, $category)
    {
        $objectHistory = new ObjectHistoryItem();
        $objectHistory->guid = $giud;
        $objectHistory->category = (int)$category;
        $objectHistory->type = $type;
        $this->_objectHistoryRepository->store($objectHistory);
    }

    /**
     * Список изменённых объектов с заданного времени и интервалом времени
     *
     * @param \DateTime $startDateTime Начальное время, с которого возвращается список изменённых объектов
     * @param \DateTime $endDateTime
     *
     * @internal param \DateInterval $dateInterval Интервал времени
     *
     * @return ObjectHistoryItem[]
     */
    function retrieve(\DateTime $startDateTime, \DateTime $endDateTime)
    {
        return $this->_objectHistoryRepository->read($startDateTime, $endDateTime);
    }
}