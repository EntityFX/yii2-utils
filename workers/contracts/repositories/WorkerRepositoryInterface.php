<?php

namespace entityfx\utils\workers\contracts\repositories;

use entityfx\utils\Limit;

interface WorkerRepositoryInterface {
    /**
     * @param int $workerId
     *
     * @return WorkerData
     */
    public function getById($workerId);

    /**
     * @param Limit $limit
     *
     * @return WorkerData
     */
    public function retrieve(Limit $limit);

    public function updateWorkerStatus(WorkerData $worker);

    /**
     * @param $workerId
     *
     * @return int[]|array
     */
    public function getWorkerWebClientIdList($workerId);

    /**
     * @return int
     */
    public function count();
}