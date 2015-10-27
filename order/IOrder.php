<?php

namespace entityfx\utils\order;

use entityfx\utils\enum\OrderDirectionEnum;

/**
 * Интерфейс для реализации сортировки
 *
 * @author EntityFX <artem.solopiy@gmail.com>
 * @package Kontinent\Components\Common\Order
 */
interface IOrder {
    /**
     * Устанавливает направление сортировки
     *
     * @param OrderDirectionEnum $direction
     */
    public function setDirection(OrderDirectionEnum $direction);

    /**
     * Возвращает направление сортировки
     *
     * @return OrderDirectionEnum
     */
    public function getDirection();

    /**
     * Возвращает поле, по которому сортировка
     *
     * @throws ValidationException
     * @return string|int
     */
    public function getField();

    /**
     * @param $attribute Атрибут сортировки
     */
    public function setAttribute($attribute);

    /**
     * @return array
     */
    public function getAttributes();

    public function getDefaultAttribute(OrderDirectionEnum $direction = null);
}