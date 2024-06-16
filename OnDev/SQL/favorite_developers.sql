CREATE TABLE favorite_developers (
  id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  developer_id int NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  KEY developer_id (developer_id)
);
