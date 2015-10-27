<?php

namespace entityfx\utils\queries;
use entityfx\utils\filters\FilterBase;
use entityfx\utils\Guid;
use entityfx\utils\Limit;
use entityfx\utils\order\OrderBase;
use ReflectionClass;
use Yii;

/**
 * Class QueryFactory
 * @author
 */
class QueryFactory {
    /**
     * @param $query string Класс запроса
     * @param FilterBase $filter Фильтр запроса
     * @param OrderBase $order Сортировка
     * @param Limit $limit Лимит
     * @return QueryInterface
     */
    public static function createFind($query, FilterBase $filter = null, OrderBase $order = null, Limit $limit = null) {
        return new $query($filter, $order, $limit);
    }

    /**
     * @param $query string Класс запроса
     * @param $id Guid|int
     * @return QueryInterface
     */
    public static function createFindById($query, $id) {
        return new $query($id);
    }

    /**
     * @param $query string Класс запроса
     * @param array $params
     * @return QueryInterface
     */
    public static function create($query, array $params = array()) {
        $class = new ReflectionClass($query);
        return $class->newInstanceArgs($params);
    }
}