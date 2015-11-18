<?php

namespace entityfx\utils\dataReplication\contracts;

use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use entityfx\utils\webService\contracts\services\WebServiceEndpoint;

interface DataReplicationManagerInterface {
    /**
     * @return ReplicationContext
     */
    public function beginUpdate();

    public function successUpdateObject(ObjectHistoryItem $updatingObject, WebServiceEndpoint $endpoint);

    public function failUpdateObject(ObjectHistoryItem $updatingObject, WebServiceEndpoint $endpoint);

    public function endUpdate();
}