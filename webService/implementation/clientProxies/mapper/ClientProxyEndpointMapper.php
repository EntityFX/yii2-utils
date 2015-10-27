<?php
/**
 * @link      http://entityfx.ru
 * @copyright Copyright (c) 2015 GDCWeather
 * @author    :
 */

namespace entityfx\utils\webService\implementation\clientProxies\mapper;


use entityfx\utils\exceptions\ManagerException;
use entityfx\utils\mappers\BusinessLogicMapperBase;
use entityfx\utils\webService\contracts\services\WebServiceEndpoint;
use entityfx\utils\webService\dataAccess\ClientProxyEndpointEntity;

class ClientProxyEndpointMapper extends BusinessLogicMapperBase {

    /**
     * @param \yii\base\Object $contract
     *
     * @return \yii\db\ActiveRecord
     */
    public function contractToEntity(\yii\base\Object $contract) {
        // TODO: Implement contractToEntity() method.
    }

    /**
     * @param \yii\db\ActiveRecord $contract
     *
     * @return \yii\base\Object
     */
    public function entityToContract(\yii\db\ActiveRecord $entity) {
        /** @var $contract ClientProxyEndpointEntity */
        if (!($entity instanceof ClientProxyEndpointEntity)) {
            throw new ManagerException("Wrong type of mapping entity");
        }

        $object          = new WebServiceEndpoint();
        $object->baseUrl = $entity->url;
        $object->id      = $entity->id;
        $object->version = $entity->version;

        return $object;
    }
}