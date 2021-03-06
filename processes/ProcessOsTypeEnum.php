<?php

namespace entityfx\utils\processes;
use entityfx\utils\enum\EnumBase;

/**
 * Class ProcessOsTypeEnum
 */
final class ProcessOsTypeEnum extends EnumBase {
    const WINDOWS = 0;
    const LINUX = 1;
    const MAC_OS_X = 2;
    const OTHER = 99;
}