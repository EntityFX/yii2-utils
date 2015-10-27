<?php
namespace entityfx\utils\crypto\activityLog;

interface ActivityEventInterface {
    /**
     * Текст события
     *
     * @return string
     */
    function getEventText();

    /**
     * Возвращает значение опреации
     *
     * @return ActivityOperationTypeInterface
     */
    function getOperationGroupType();
}
