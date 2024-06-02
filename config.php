<?php

    $usuario = 'root';
    $senha = '@Vinishireis2005';
    $database = 'login_new';
    $host = 'localhost';

    // Aqui, você deve usar "mysqli" (nome da classe) em vez de "$mysqli" (nome da variável)
    $mysqli = new mysqli($host, $usuario, $senha, $database);

    // Verifica se houve erros na conexão
    if($mysqli->connect_errno) {
        die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
    }
    
    // Verifica se a conexão foi estabelecida com sucesso
    if ($mysqli->ping()) {
        // Conexão bem-sucedida
    } else {
        // Falha na conexão
        die("Falha ao conectar ao banco de dados: " . $mysqli->error);
    } 
    return $mysqli;