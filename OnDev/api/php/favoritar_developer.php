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

// Verifica se o ID do desenvolvedor foi fornecido no POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['developer_id'])) {
        echo "ID do desenvolvedor não fornecido.";
        exit;
    }

    $developer_id = $_POST['developer_id'];

    // Verifica se o desenvolvedor já está na lista de favoritos do usuário
    $query_check = "SELECT * FROM favorite_developers WHERE user_id = ? AND developer_id = ?";
    $stmt_check = mysqli_prepare($mysqli, $query_check);
    mysqli_stmt_bind_param($stmt_check, "ii", $usuario_id, $developer_id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "Este desenvolvedor já está na sua lista de favoritos.";
        exit;
    }

    mysqli_stmt_close($stmt_check);

    // Inserção na tabela favorite_developers
    $query = "INSERT INTO favorite_developers (user_id, developer_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $developer_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Desenvolvedor favoritado com sucesso.";
    } else {
        echo "Erro ao favoritar o desenvolvedor.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Método de requisição inválido.";
}
?>
