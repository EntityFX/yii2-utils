<?php

namespace entityfx\utils\workers\contracts;

interface WorkerInterceptorInterface {

    /**
     * @return WorkerInterface
     */
    public function getWorker();

    public function processRun(array $args);
}