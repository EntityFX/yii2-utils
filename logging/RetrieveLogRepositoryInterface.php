<?php
namespace entityfx\utils\logging;

use entityfx\utils\Limit;
use Traversable;

interface RetrieveLogRepositoryInterface {
    /**
     * @param LoggingFilter $filter
     * @param LoggingOrder  $order
     * @param Limit         $limit
     *
     * @return LoggingData[]|Traversable
     */
    public function read(LoggingFilter $filter, LoggingOrder $order, Limit $limit);

    public function count(LoggingFilter $filter);
}