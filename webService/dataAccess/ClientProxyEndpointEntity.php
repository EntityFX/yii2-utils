<?php

namespace entityfx\utils\webService\dataAccess;

use yii\db\ActiveRecord;

/**
 * @link      http://entityfx.ru
 * @copyright Copyright (c) 2015 GDCWeather
 * @author    :
 */
class ClientProxyEndpointEntity extends ActiveRecord {
    public static function tableName() {
        return 'Utils_ClientProxyEndpoint';
    }

    public function getVendor() {
        return $this->hasOne(ClientProxyEntity::className(), ['id' => 'proxyId']);
    }
}