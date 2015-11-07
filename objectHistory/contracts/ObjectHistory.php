<?php

namespace entityfx\utils\objectHistory\contracts;
use entityfx\utils\ModelGuidBase;
use yii\base\Object;

/**
 * Class ObjectHistory
 *
 * @property-read int $visibleID Идентификатор
 * @property-read Guid                  $guid
 * @property ObjectHistoryTypeEnum      $type
 * @property ObjectHistoryCategoryEnum  $category
 * @property DateTime                   $changeDateTime
 * @property int                        $priority
 */
class ObjectHistory extends ModelGuidBase {
    /**
     * @var ObjectHistoryTypeEnum
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
     * @param ObjectHistoryCategoryEnum $category
     */
    public function setCategory(ObjectHistoryCategoryEnum $category) {
        $this->_category = $category;
    }

    /**
     * @return ObjectHistoryCategoryEnum
     */
    public function getCategory() {
        return $this->_category;
    }

    /**
     * @param ObjectHistoryTypeEnum $type
     */
    public function setType(ObjectHistoryTypeEnum $type) {
        $this->_type = $type;
    }

    /**
     * @return ObjectHistoryTypeEnum
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * @var ObjectHistoryCategoryEnum;
     */
    private $_category;
}