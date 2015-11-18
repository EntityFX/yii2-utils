CREATE TABLE `Utils_ClientProxyEndpoint` (
  id        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT
  COMMENT 'Id �������� ����� ������-�������',
  url       VARCHAR(255)     NOT NULL
  COMMENT 'Url-����� �������� �����',
  `version` TINYINT(4)       NULL
  COMMENT '������ �������� �����',
  proxyId   INT(11) UNSIGNED NOT NULL
  COMMENT 'Id ����������� ������',
  PRIMARY KEY (id),
  CONSTRAINT FK__ClientProxyEndpoint__id FOREIGN KEY (proxyId)
  REFERENCES Utils_ClientProxy (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET utf8
  COLLATE utf8_general_ci
  COMMENT = '������� ������ ��������';