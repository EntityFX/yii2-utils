<?php

namespace entityfx\utils\objectHistory\contracts\repositories;
use entityfx\utils\objectHistory\contracts\ObjectHistory;
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
     * @param ObjectHistory $domainObject Информация об объекте
     *
     */
    public function store(ObjectHistory $domainObject);

    /**
     * Список изменённых объектов с заданного времени и интервалом времени
     *
     * @param DateTime $startDateTime Начальное время, с которого возвращается список изменённых объектов
     * @param DateTime $endDateTime
     *
     * @internal param \DateInterval $dateInterval Интервал времени
     *
     * @return ObjectHistory[]
     */
    public function read(DateTime $startDateTime, DateTime $endDateTime);
}