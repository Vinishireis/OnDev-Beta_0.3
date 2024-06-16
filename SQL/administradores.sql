CREATE TABLE administradores (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(100) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
);

INSERT INTO administradores (nome, email, password)
VALUES ('Admin', 'ondev.org@gmail.com', '$2y$10$oqq9Eka2ONCctQ/FlPH/F.YL2/DEPR16Q1qB917uzEtYCXbHyAhFG');