<?php

namespace entityfx\utils;

use entityfx\utils\enum\OrderDirectionEnum;
use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\order\OrderBase;
use yii\di\ServiceLocator;

/**
 * Description of Services
 *
 * @author EntityFX
 * @package Kontinent\Components\Common
 *
 * @property-read BusinessLogicMapperBase $mapper
 *
 */
abstract class ManagerBase extends ComponentBase
{

    const SERVICE_CATEGORY    = 'application.components.services';
    const FAULT_BAD_OPERATION = 111;

    /**
     * @var BusinessLogicMapperBase;
     *      */
    private $_mapper;

    public function __construct() {
        $this->_mapper = $this->initMapper();
    }

    /**
     * @return BusinessLogicMapperBase
     */
    protected function getMapper() {
        return $this->_mapper;
    }

    protected function initMapper() {
        return null;
    }

    protected function getOrderExpression(OrderBase $order, callable $func) {
        $fieldName = $func($order);
        if (empty($fieldName)) return '';
        $direction = $order->getDirection()->getValue() === OrderDirectionEnum::ASC ? 'ASC' : 'DESC';

        return $fieldName . ' ' . $direction;
    }
}