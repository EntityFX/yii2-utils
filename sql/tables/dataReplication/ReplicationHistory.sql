CREATE TABLE `Utils_ReplicationHistory` (
    `id`                    INT UNSIGNED NOT NULL    COMMENT 'Идентификатор' AUTO_INCREMENT PRIMARY KEY,
    `startDatetime`       DATETIME     NOT NULL    COMMENT 'Время начала выгрузки',
    `boundaryDatetime`    DATETIME     NULL        COMMENT 'Время фиксации',
    `endDatetime`         DATETIME     NULL        COMMENT 'Время окончания выгрузки'
)
COMMENT ='История выгрузок'
ENGINE ='InnoDB';