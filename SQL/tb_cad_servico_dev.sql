CREATE TABLE tb_cad_servico_dev (
  id int NOT NULL AUTO_INCREMENT,
  titulo varchar(255) NOT NULL,
  descricao text NOT NULL,
  instrucao text,
  categoria enum('Sites','Mobile','Design') NOT NULL,
  valor decimal(10,2) NOT NULL,
  tempo int NOT NULL,
  img varchar(255) DEFAULT NULL,
  id_developer int NOT NULL,
  data_criacao timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  status enum('ativo','pausado') NOT NULL DEFAULT 'ativo',
  bloqueado tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  KEY id_developer (id_developer)
);
