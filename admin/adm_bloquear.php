<?php
session_start();
include_once('../config.php');

// Verificar se a conexão com o banco de dados foi estabelecida corretamente
if (!$mysqli) {
    die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
}

// Verificar se a requisição é do tipo POST e se os parâmetros necessários estão presentes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['tipo'])) {
    $id = intval($_POST['id']); // Assegura que o ID seja um inteiro
    $tipo_selecionado = $_POST['tipo'];

    // Determinar o nome da tabela com base no tipo selecionado
    switch ($tipo_selecionado) {
        case 'usuario':
            $table_name = 'tb_cadastro_users';
            break;
        case 'desenvolvedor':
            $table_name = 'tb_cadastro_developer';
            break;
        case 'servico':
            $table_name = 'tb_cad_servico_dev';
            break;
        default:
            die('Tipo inválido selecionado');
    }

    // Preparar e executar a consulta para bloquear o registro
    $sql = "UPDATE $table_name SET bloqueado = 1 WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

   

    if ($stmt) {
        $stmt->bind_param("i", $id);

        // Executar a consulta preparada
        if ($stmt->execute()) {
            // Redirecionar após o bloqueio ser realizado com sucesso
            header("Location: dash_adm.php");
            exit();
        } else {
            echo "Erro ao executar a operação de bloqueio: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }
} else {
    // Caso os parâmetros não sejam recebidos corretamente, redirecionar para a página dash_adm.php
    header("Location: dash_adm.php");
    exit();
}

$mysqli->close();
?>




