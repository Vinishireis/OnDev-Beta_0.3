<?php
include_once('../../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Atualizar o status do serviço para 'cancelado'
    $query = "UPDATE tb_servicos_contratados SET status='cancelado' WHERE id=?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Serviço removido com sucesso.";
    } else {
        echo "Erro ao remover o serviço.";
    }
}
?>