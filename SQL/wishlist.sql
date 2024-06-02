CREATE TABLE wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    developer_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tb_cadastro_users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (service_id) REFERENCES tb_cad_servico_dev(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (developer_id) REFERENCES tb_cadastro_developer(id) ON DELETE CASCADE ON UPDATE CASCADE
);
