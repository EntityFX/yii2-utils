<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.11.15
 * Time: 14:14
 */

namespace entityfx\utils\objectHistory;


use entityfx\utils\Guid;
use entityfx\utils\objectHistory\contracts\enums\HistoryTypeEnum;
use yii\base\Event;

class ObjectHistoryEvent extends Event {
    /**
     * @var HistoryTypeEnum
     */
    private $historyType;
    /**
     * @var Guid
     */
    private $guid;

    /**
     * @return HistoryTypeEnum
     */
    public function getHistoryType()
    {
        return $this->historyType;
    }

    /**
     * @return Guid
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var int
     */
    private $category;

    public function __construct(HistoryTypeEnum $historyType, Guid $guid, $category) {
        $this->historyType = $historyType;
        $this->guid = $guid;
        $this->category = (int)$category;
        parent::__construct();
    }
}