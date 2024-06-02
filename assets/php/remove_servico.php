<?php
// Certifique-se de que você tem a sessão iniciada
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    echo "Usuário não está logado.";
    exit;
}

// Inclua o arquivo de configuração do banco de dados
include_once('../../login_new/config.php');

// Recupere o ID do usuário da sessão
$usuario_id = $_SESSION['id'];

// Verifique se o ID do serviço foi fornecido na URL
if (!isset($_GET['id'])) {
    echo "ID do serviço não fornecido.";
    exit;
}

$servico_id = $_GET['id'];

// Consulta SQL para verificar se o serviço existe na lista de desejos do usuário
$query = "SELECT * FROM wishlist WHERE user_id = ? AND service_id = ?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $servico_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se o serviço foi encontrado na lista de desejos do usuário
if (mysqli_num_rows($result) > 0) {
    // Remove o serviço da tabela de desejos
    $query_delete = "DELETE FROM wishlist WHERE user_id = ? AND service_id = ?";
    $stmt_delete = mysqli_prepare($mysqli, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, "ii", $usuario_id, $servico_id);
    mysqli_stmt_execute($stmt_delete);

    if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
        echo "Serviço removido com sucesso.";
    } else {
        echo "Erro ao remover o serviço.";
    }

    mysqli_stmt_close($stmt_delete);
} else {
    echo "O serviço não foi encontrado na lista de desejos do usuário.";
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);

// Após a remoção bem-sucedida, redirecione de volta para wishlist.php
header('Location: ../../wishlist.php');
exit;
?>
