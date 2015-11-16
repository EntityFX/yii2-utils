<?php

namespace entityfx\utils\objectHistory\contracts;
use entityfx\utils\objectHistory\contracts\enums\HistoryTypeEnum;

/**
 * Created by PhpStorm.
 * User: Гузалия
 * Date: 08.11.2015
 * Time: 1:41
 */
interface ObjectHistoryManagerInterface {
    function objectModified(HistoryTypeEnum $type, $giud, $category);

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
    function retrieve(\DateTime $startDateTime, \DateTime $endDateTime);
}