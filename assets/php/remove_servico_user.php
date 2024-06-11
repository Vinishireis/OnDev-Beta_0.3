<?php
include_once('../../config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Atualizar o status do serviço para "cancelado"
    $query = "UPDATE tb_servicos_contratados SET status='cancelado' WHERE id=?";
    $stmt = mysqli_prepare($mysqli, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);
    $execute_result = mysqli_stmt_execute($stmt);

    if ($execute_result === false) {
        echo "error: " . mysqli_error($mysqli); // Adicionando mensagem de erro específica do MySQL
    } else {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "success";
        } else {
            echo "error: Nenhuma linha afetada"; // Adicionando mensagem específica caso nenhuma linha seja afetada
        }
    }
}
?>