CREATE TABLE `Utils_Worker` (
  id               INT(11)     UNSIGNED      NOT NULL    AUTO_INCREMENT
  COMMENT '������������� ������� ��������',
  `name`           VARCHAR(50)               NOT NULL
  COMMENT '��� ������� ��������',
  class            VARCHAR(50)               NOT NULL
  COMMENT '����� ������� ��������',
  `status`         TINYINT(4)                NOT NULL
  COMMENT '������ �������',
  startDatetime    DATETIME                  NULL
  COMMENT '������ ������ �������',
  endDatetime      DATETIME                  NULL
  COMMENT '����� ������ �������',
  pid              INT(11)     UNSIGNED      NULL
  COMMENT 'PID �������� �������',
  description      VARCHAR(100)              NULL
  COMMENT '��������',
  xmlConfiguration TEXT
                   COLLATE 'utf8_general_ci' NULL
  COMMENT 'XML ������������ �������',
  PRIMARY KEY (id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET utf8
  COLLATE utf8_general_ci
  COMMENT = '������� �������� ��������';