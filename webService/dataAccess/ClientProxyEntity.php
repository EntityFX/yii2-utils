<?php

namespace entityfx\utils\webService\dataAccess;

use yii\db\ActiveRecord;

/**
 * @link      http://entityfx.ru
 * @copyright Copyright (c) 2015 GDCWeather
 * @author    :
 */
class ClientProxyEntity extends ActiveRecord {
    public static function tableName() {
        return 'Utils_ClientProxy';
    }

    public function getEndpoints() {
        return $this->hasMany(ClientProxyEndpointEntity::className(), ['proxyId' => 'id']);
    }
}