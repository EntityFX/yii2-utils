CREATE TABLE `Utils_ClientProxy` (
  id       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT
  COMMENT 'Id ������-�������',
  contract VARCHAR(50)      NOT NULL
  COMMENT '��� ���������� ������ �������',
  type     TINYINT(4)       NOT NULL
  COMMENT '��� ������',
  PRIMARY KEY (id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET utf8
  COLLATE utf8_general_ci
  COMMENT = '������� ������ ��������';