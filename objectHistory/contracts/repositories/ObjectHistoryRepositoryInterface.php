<?php

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
    public function add(ObjectHistory $domainObject);

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
    public function read(DateTime $startDateTime, DateTime $endDateTime);
}