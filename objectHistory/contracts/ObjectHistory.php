<?php

namespace entityfx\utils\objectHistory\contracts;
use DateTime;
use entityfx\utils\Guid;
use entityfx\utils\ModelGuidBase;
use entityfx\utils\objectHistory\contracts\enums\HistoryTypeEnum;
use yii\base\Object;

/**
 * Class ObjectHistory
 *
 * @property Guid                  $guid
 * @property HistoryTypeEnum      $type
 * @property int  $category
 * @property DateTime                   $changeDateTime
 * @property int                        $priority
 */
class ObjectHistory extends ModelGuidBase {
    /**
     * @var HistoryTypeEnum
     */
    private $_type;

    /**
     * @param int $priority
     */
    public function setPriority($priority) {
        $this->_priority = (int)$priority;
    }

    /**
     * @return int
     */
    public function getPriority() {
        return $this->_priority;
    }

    /**
     * @var int
     */
    private $_priority;

    /**
     * @param DateTime $changeDateTime
     */
    public function setChangeDateTime(DateTime $changeDateTime) {
        $this->_changeDateTime = $changeDateTime;
    }

    /**
     * @return DateTime
     */
    public function getChangeDateTime() {
        return $this->_changeDateTime;
    }

    /**
     * @var DateTime
     */
    private $_changeDateTime;

    /**
     * @param int $category
     */
    public function setCategory($category) {
        $this->_category = (int)$category;
    }

    /**
     * @return int
     */
    public function getCategory() {
        return $this->_category;
    }

    /**
     * @param HistoryTypeEnum $type
     */
    public function setType(HistoryTypeEnum $type) {
        $this->_type = $type;
    }

    /**
     * @return HistoryTypeEnum
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * @var int;
     */
    private $_category;
}