CREATE TABLE tb_cadastro_users (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(100) DEFAULT NULL,
  sobrenome varchar(100) DEFAULT NULL,
  cpf varchar(14) DEFAULT NULL,
  data_nasc date DEFAULT NULL,
  genero ENUM('M', 'F') DEFAULT NULL,
  ddd varchar(2) DEFAULT NULL,
  telefone varchar(9) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  -- Store hashed password instead of plain text
  password varchar(255) DEFAULT NULL,
  cep varchar(9) DEFAULT NULL,
  -- Consider using an address data type if applicable
  rua varchar(255) DEFAULT NULL,
  numero varchar(10) DEFAULT NULL,
  complemento varchar(100) DEFAULT NULL,
  bairro varchar(100) DEFAULT NULL,
  cidade varchar(100) DEFAULT NULL,
  estado varchar(2) DEFAULT NULL,
  foto_perfil varchar(255) DEFAULT NULL,
  reset_token_hash varchar(64) DEFAULT NULL,
  reset_token_expires_at datetime DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email),
  UNIQUE KEY reset_token_hash (reset_token_hash)
);
