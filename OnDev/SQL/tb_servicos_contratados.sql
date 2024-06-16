CREATE TABLE tb_servicos_contratados (
  id int NOT NULL AUTO_INCREMENT,
  service_id int NOT NULL,
  user_id int NOT NULL,
  developer_id int NOT NULL,
  data_contratacao datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status enum('Pendente','Em progresso','Completo','Cancelado') NOT NULL DEFAULT 'Pendente',
  PRIMARY KEY (id),
  KEY service_id (service_id),
  KEY user_id (user_id),
  KEY developer_id (developer_id)
);
