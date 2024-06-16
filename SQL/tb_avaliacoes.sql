CREATE TABLE tb_avaliacoes (
  id int NOT NULL AUTO_INCREMENT,
  service_id int NOT NULL,
  user_id int NOT NULL,
  developer_id int NOT NULL,
  avaliacao enum('Péssimo','Ruim','Bom','Ótimo','Excelente') NOT NULL,
  comentario text,
  data_avaliacao timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY service_id (service_id),
  KEY user_id (user_id),
  KEY developer_id (developer_id)
);
