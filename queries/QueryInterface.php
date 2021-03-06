<?php

namespace entityfx\utils\queries;

use yii\db\Query;

/**
 * Class IQuery
 * @author EntityFX
 */
interface QueryInterface {
    /**
     * @return Query команда запроса
     */
    function getCommand();
}