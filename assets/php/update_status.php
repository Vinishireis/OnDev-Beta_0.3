<?php
include_once('../../config.php');

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Atualizar o status do serviço
    $query = "UPDATE tb_servicos_contratados SET status=? WHERE id=?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Status atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o status.";
    }
}
?>