<?php

namespace entityfx\utils\objectHistory\contracts\repositories;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use DateTime;

/**
 * Created by PhpStorm.
 * User: Гузалия
 * Date: 08.11.2015
 * Time: 2:06
 */
interface ObjectHistoryRepositoryInterface {
    /**
     * Добавляет информацию об изменённом объекте в репозиторий истории
     *
     * @param ObjectHistoryItem $domainObject Информация об объекте
     *
     */
    public function store(ObjectHistoryItem $domainObject);

    /**
     * Список изменённых объектов с заданного времени и интервалом времени
     *
     * @param DateTime $startDateTime Начальное время, с которого возвращается список изменённых объектов
     * @param DateTime $endDateTime
     *
     *
     * @return ObjectHistoryItem[]
     */
    public function read(DateTime $startDateTime, DateTime $endDateTime);
}