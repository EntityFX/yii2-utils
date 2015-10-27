<?php

namespace entityfx\utils\workers\contracts\repositories;
use entityfx\utils\enum\EnumBase;

/**
 * Class WorkerStatusEnum
 *
 * @author EntityFX <artem.solopiy@gmail.com>
 */
class WorkerStatusEnum extends EnumBase {
    const ACTIVE = 0;
    const IN_PROGRESS = 1;
    const FAILED = 2;
}