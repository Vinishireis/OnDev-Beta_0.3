<?php
// Certifique-se de que você tem a sessão iniciada
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    echo "Usuário não está logado.";
    exit;
}

// Inclua o arquivo de configuração do banco de dados
include_once('../../config.php');

// Recupere o ID do usuário da sessão
$usuario_id = $_SESSION['id'];

// Verifique se o ID do desenvolvedor foi fornecido na URL
if (!isset($_GET['id'])) {
    echo "ID do desenvolvedor não fornecido.";
    exit;
}

$developer_id = $_GET['id'];

// Consulta SQL para verificar se o desenvolvedor existe na lista de favoritos do usuário
$query = "SELECT * FROM favorite_developers WHERE user_id = ? AND developer_id = ?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $developer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se o desenvolvedor foi encontrado na lista de favoritos do usuário
if (mysqli_num_rows($result) > 0) {
    // Remove o desenvolvedor da tabela de favoritos
    $query_delete = "DELETE FROM favorite_developers WHERE user_id = ? AND developer_id = ?";
    $stmt_delete = mysqli_prepare($mysqli, $query_delete);
    mysqli_stmt_bind_param($stmt_delete, "ii", $usuario_id, $developer_id);
    mysqli_stmt_execute($stmt_delete);

    if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
        echo "Desenvolvedor removido com sucesso.";
    } else {
        echo "Erro ao remover o desenvolvedor.";
    }

    mysqli_stmt_close($stmt_delete);
} else {
    echo "O desenvolvedor não foi encontrado na lista de favoritos do usuário.";
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);

// Após a remoção bem-sucedida, redirecione de volta
header('Location: ../../favorite_developer.php');
exit;
?>