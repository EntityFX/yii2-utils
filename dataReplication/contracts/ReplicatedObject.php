<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.15
 * Time: 16:36
 */

namespace entityfx\utils\dataReplication\contracts;
use entityfx\utils\objectHistory\contracts\ObjectHistoryItem;
use entityfx\utils\objectHistory\ObjectHistory;
use entityfx\utils\webService\contracts\services\WebServiceEndpoint;
use yii\base\Object;

/**
 * Class UpdatedObject
 *
 * @property ObjectHistoryItem      $objectHistory        Данные выгружаемого объекта
 * @property int                $updateId             ID выгрузки
 * @property \DateTime           $updateObjectDateTime Дата выгруженного объекта
 * @property boolean            $success              Успех выгрузки
 * @property WebServiceEndpoint $endpoint             Конечная точка выгруженного объекта
 * @author EntityFX <artem.solopiy@gmail.com>
 */
class ReplicatedObject extends Object {

    /**
     * @var ObjectHistory
     */
    private $_objectHistory;
    /**
     * @var WebServiceEndpoint
     */
    private $_endpoint;
    /**
     * @var int
     */
    private $_updateId;

    /**
     * @var bool
     */
    private $_success;

    /**
     * @param boolean $success
     */
    public function setSuccess($success) {
        $this->_success = (bool)$success;
    }

    /**
     * @return boolean
     */
    public function getSuccess() {
        return $this->_success;
    }

    /**
     * @var \DateTime
     */
    private $_updateObjectDateTime;

    /**
     * @return WebServiceEndpoint
     */
    public function getEndpoint() {
        return $this->_endpoint;
    }

    /**
     * @param WebServiceEndpoint $endpoint
     */
    public function setEndpoint(WebServiceEndpoint $endpoint) {
        $this->_endpoint = $endpoint;
    }

    /**
     * @return ObjectHistory
     */
    public function getObjectHistory() {
        return $this->_objectHistory;
    }

    /**
     * @param ObjectHistoryItem $value
     */
    public function setObjectHistory(ObjectHistoryItem $value) {
        $this->_objectHistory = $value;
    }

    /**
     * @return int
     */
    public function getUpdateId() {
        return $this->_updateId;
    }

    /**
     * @param int $updateId
     */
    public function setUpdateId($updateId) {
        $this->_updateId = (int)$updateId;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateObjectDateTime() {
        return $this->_updateObjectDateTime;
    }

    /**
     * @param \DateTime $updateObjectDateTime
     */
    public function setUpdateObjectDateTime(\DateTime $updateObjectDateTime) {
        $this->_updateObjectDateTime = $updateObjectDateTime;
    }
}