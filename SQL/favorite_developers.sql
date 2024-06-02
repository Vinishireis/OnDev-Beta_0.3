CREATE TABLE favorite_developers (
  id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  developer_id int NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),tb_cadastro_developertb_cadastro_developer
  foreign key (user_id) References tb_cadastro_users(id),
  foreign key (developer_id) References tb_cadastro_developer(id)
);