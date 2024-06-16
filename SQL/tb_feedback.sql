CREATE TABLE tb_feedback (
  id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  nome varchar(100) NOT NULL,
  avaliacao text NOT NULL,
  data_avaliacao datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES tb_cadastro_users(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;