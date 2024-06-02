CREATE TABLE tb_servicos_contratados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    user_id INT NOT NULL,
    developer_id INT NOT NULL,
    data_contratacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('em aberto', 'em progresso', 'iniciado', 'concluído', 'cancelado') NOT NULL DEFAULT 'em aberto',
    FOREIGN KEY (service_id) REFERENCES tb_cad_servico_dev(id),
    FOREIGN KEY (user_id) REFERENCES tb_cadastro_users(id),
    FOREIGN KEY (developer_id) REFERENCES tb_cadastro_developer(id)
);
