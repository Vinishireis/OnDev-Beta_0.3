CREATE TABLE wishlist (
  id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  service_id int NOT NULL,
  developer_id int NOT NULL,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
