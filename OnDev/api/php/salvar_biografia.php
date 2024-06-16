<?php
session_start();

if (isset($_SESSION['id']) && isset($_POST['biografia'])) {
    $id_usuario = $_SESSION['id'];
    $biografia = $_POST['biografia'];

    // Incluir o arquivo de configuração do banco de dados
    include_once('../../config.php');

    // Atualizar a biografia na tabela
    $query_update = "UPDATE tb_cadastro_developer SET biografia = ? WHERE id = ?";
    $stmt_update = $mysqli->prepare($query_update);
    if ($stmt_update === false) {
        echo "Erro na preparação da consulta: " . $mysqli->error;
        exit;
    }
    $stmt_update->bind_param("si", $biografia, $id_usuario);
    if ($stmt_update->execute()) {
        // Redirecionar de volta para o dashboard
        header("Location: ../../dashboard.php");
        exit;
    } else {
        echo "Erro ao atualizar a biografia: " . $stmt_update->error;
        exit;
    }
} else {
    // Se não houver sessão ativa ou biografia no POST, redireciona para página de erro 404
    header("Location: 404.php");
    exit;
}
?>