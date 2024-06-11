<?php
session_start();
include_once('../../config.php');
header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Erro desconhecido.'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
    $nova_senha = $_POST['password'];
    $confirmacao_senha = $_POST['password_confirmation'];

    if ($nova_senha === $confirmacao_senha) {
        $hash_senha = password_hash($nova_senha, PASSWORD_DEFAULT);

        $sql = "UPDATE tb_cadastro_users SET password = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $hash_senha, $id_usuario);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Senha alterada com sucesso.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Erro ao alterar a senha.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'As senhas não coincidem.'];
    }
}

echo json_encode($response);
?>