CREATE TABLE Utils_ReplicatedObject (
  id              INT(10) UNSIGNED NOT NULL
  COMMENT 'Идентификатор выгрузки',
  objectHistoryId BINARY(16)       NOT NULL
  COMMENT 'ID записи в истории объектов',
  endpointId      INT(11) UNSIGNED NOT NULL
  COMMENT 'Id конечной точки',
  createDatetime  DATETIME         NOT NULL
  COMMENT 'Дата создания',
  success         TINYINT(1)       NOT NULL
  COMMENT 'Успех',
  PRIMARY KEY (id, objectHistoryId, endpointId),
  CONSTRAINT FK__ReplicatedObject_id__ClientProxyEndpoint_id FOREIGN KEY (endpointId)
  REFERENCES Utils_ClientProxyEndpoint (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT FK__ReplicatedObject_ohid__ObjectHistory_objectHistoryId FOREIGN KEY (objectHistoryId)
  REFERENCES Utils_ObjectHistory (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT FK__ReplicatedObject_id__ReplicationHistory_id FOREIGN KEY (id)
  REFERENCES Utils_ReplicationHistory (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)
  ENGINE = INNODB
  COMMENT = 'История выгруженных объектов';