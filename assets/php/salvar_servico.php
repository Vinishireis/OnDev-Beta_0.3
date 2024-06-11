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

// Verifica se o ID do serviço foi fornecido no POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['service_id'])) {
        echo "ID do serviço não fornecido.";
        exit;
    }

    $servico_id = $_POST['service_id'];

    // Consulta SQL para recuperar os dados do desenvolvedor associado ao serviço
    $query_servico = "SELECT id_developer FROM tb_cad_servico_dev WHERE id = ?";
    $stmt_servico = mysqli_prepare($mysqli, $query_servico);
    mysqli_stmt_bind_param($stmt_servico, "i", $servico_id);
    mysqli_stmt_execute($stmt_servico);
    $result_servico = mysqli_stmt_get_result($stmt_servico);

    if ($row_servico = mysqli_fetch_assoc($result_servico)) {
        $id_developer = $row_servico['id_developer'];
    } else {
        echo "Serviço ou desenvolvedor não encontrado.";
        exit;
    }

    mysqli_stmt_close($stmt_servico);

    // Inserção na tabela wishlist
    $query = "INSERT INTO wishlist (user_id, service_id, developer_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "iii", $usuario_id, $servico_id, $id_developer);

    if (mysqli_stmt_execute($stmt)) {
        echo "Serviço salvo com sucesso.";
    } else {
        echo "Erro ao salvar o serviço.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Método de requisição inválido.";
}
?>
