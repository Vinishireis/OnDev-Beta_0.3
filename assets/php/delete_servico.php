<?php
// Certifique-se de que você tem a sessão iniciada
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401); // Unauthorized
    echo "Usuário não está logado.";
    exit;
}

// Inclua o arquivo de configuração do banco de dados
include_once('../../login_new/config.php');

// Recupere o ID do serviço a ser removido
if (!isset($_GET['id'])) {
    http_response_code(400); // Bad Request
    echo "ID do serviço não fornecido.";
    exit;
}

$servico_id = $_GET['id'];

// Consulta SQL para verificar se o serviço existe
$query = "SELECT * FROM tb_cad_servico_dev WHERE id = ?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $servico_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se o serviço foi encontrado
if (mysqli_num_rows($result) > 0) {
    // Remove o serviço da tabela tb_cad_servico_dev
    $query_delete = "DELETE FROM tb_cad_servico_dev WHERE id = ?";
    $stmt_delete = mysqli_prepare($mysqli, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, "i", $servico_id);
    mysqli_stmt_execute($stmt_delete);

    if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
        http_response_code(200); // OK
        echo "Serviço removido com sucesso.";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Erro ao remover o serviço.";
    }

    mysqli_stmt_close($stmt_delete);
} else {
    http_response_code(404); // Not Found
    echo "O serviço não foi encontrado.";
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);

exit;
?>