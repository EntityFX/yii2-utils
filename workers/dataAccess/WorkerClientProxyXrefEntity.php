<?php
/**
 * @link      http://entityfx.ru
 * @copyright Copyright (c) 2015 GDCWeather
 * @author    :
 */

namespace entityfx\utils\workers\dataAccess;


use yii\db\ActiveRecord;

class WorkerClientProxyXrefEntity extends ActiveRecord {
    public static function tableName() {
        return 'Utils_WorkerClientProxyXref';
    }
}