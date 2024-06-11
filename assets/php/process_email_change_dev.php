<?php
session_start();
include_once('../../config.php');
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Erro desconhecido.'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
    $novo_email = $_POST['new_email'];

    if (filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        // Verificar se o e-mail já está em uso
        $sql_check = "SELECT id FROM tb_cadastro_users WHERE email = ?";
        $stmt_check = $mysqli->prepare($sql_check);
        $stmt_check->bind_param("s", $novo_email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $response = ['status' => 'error', 'message' => 'E-mail já está em uso.'];
        } else {
            $sql = "UPDATE tb_cadastro_users SET email = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $novo_email, $id_usuario);

            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'E-mail alterado com sucesso.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Erro ao alterar o e-mail.'];
            }
        }
    } else {
        $response = ['status' => 'error', 'message' => 'E-mail inválido.'];
    }
}

echo json_encode($response);
