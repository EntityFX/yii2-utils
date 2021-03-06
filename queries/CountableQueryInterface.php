<?php

namespace entityfx\utils\queries;
use yii\db\Query;

/**
 * Class ICountableQuery
 * @author EntityFX
 */
interface CountableQueryInterface extends QueryInterface {
    /**
     * @return Query
     */
    function getCountCommand();
}