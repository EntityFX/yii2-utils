<?php
namespace entityfx\utils\objectHistory\contracts\enums;
use entityfx\utils\enum\EnumBase;

/**
 * Created by JetBrains PhpStorm.
 * User: EntityFX
 * Date: 09.08.13
 * Time: 16:58
 */

final class HistoryTypeEnum extends EnumBase {
    const CREATE = 0;
    const UPDATE = 1;
    const DELETE = 2;

    const EXISTS = 3;
}