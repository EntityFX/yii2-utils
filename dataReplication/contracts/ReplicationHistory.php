<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.15
 * Time: 14:50
 */

namespace entityfx\utils\dataReplication\contracts;


use yii\base\Object;

/**
 * Class UpdateHistory
 *
 * @author EntityFX <artem.solopiy@gmail.com>
 * @property int      $updateId         ID выгрузки
 * @property \DateTime $startDateTime    Дата начала выгрузки
 * @property \DateTime $boundaryDateTime Дата последнего изменения
 * @property \DateTime $endDateTime      Дата последнего изменения
 */
class ReplicationHistory extends Object {
    /**
     * @var int
     */
    private $_updateId;
    /**
     * @var \DateTime
     */
    private $_startDateTime;
    /**
     * @var \DateTime
     */
    private $_boundaryDateTime;
    /**
     * @var \DateTime
     */
    private $_endDateTime;

    /**
     * @return \DateTime
     */
    public function getBoundaryDateTime() {
        return $this->_boundaryDateTime;
    }

    /**
     * @param \DateTime $boundaryDateTime
     */
    public function setBoundaryDateTime(\DateTime $boundaryDateTime = null) {
        $this->_boundaryDateTime = $boundaryDateTime;
    }

    /**
     * @return \DateTime
     */
    public function getEndDateTime() {
        return $this->_endDateTime;
    }

    /**
     * @param \DateTime $endDateTime
     */
    public function setEndDateTime(\DateTime $endDateTime = null) {
        $this->_endDateTime = $endDateTime;
    }

    /**
     * @return \DateTime
     */
    public function getStartDateTime() {
        return $this->_startDateTime;
    }

    /**
     * @param \DateTime $startDateTime
     */
    public function setStartDateTime(\DateTime $startDateTime) {
        $this->_startDateTime = $startDateTime;
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
}