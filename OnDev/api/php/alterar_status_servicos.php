<?php
session_start();
include_once('../../config.php');

if (isset($_SESSION['id'])) {
    $id_servico = $_GET['id'];
    $acao = $_GET['acao'];

    if ($acao == 'pausar') {
        $novo_status = 'pausado';
    } elseif ($acao == 'ativar') {
        $novo_status = 'ativo';
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ação inválida.'));
        exit;
    }

    $query = "UPDATE tb_cad_servico_dev SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "si", $novo_status, $id_servico);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array('status' => 'success', 'message' => 'Status do serviço atualizado com sucesso.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Erro ao atualizar o status do serviço: ' . mysqli_error($mysqli)));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Você precisa estar logado para alterar o status de um serviço.'));
}