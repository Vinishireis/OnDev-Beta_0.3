<?php
// Inicia a sessão
session_start();

// Inclua o arquivo de configuração do banco de dados
include_once('../../config.php');

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Recupere o ID do serviço e a ação (pausar ou ativar)
    $id_servico = $_GET['id'];
    $acao = $_GET['acao'];
    
    // Verifica a ação e define o novo status
    if ($acao == 'pausar') {
        $novo_status = 'pausado';
    } elseif ($acao == 'ativar') {
        $novo_status = 'ativo';
    } else {
        echo "Ação inválida.";
        exit;
    }
    
    // Atualiza o status do serviço no banco de dados
    $query = "UPDATE tb_cad_servico_dev SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "si", $novo_status, $id_servico);
    if (mysqli_stmt_execute($stmt)) {
        echo "Status do serviço atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o status do serviço.";
    }

    // Redireciona de volta para a página de exibição de serviços
    header("Location: ../../dashviewserv.php");
    exit;
} else {
    echo "Você precisa estar logado para alterar o status de um serviço.";
}
?>
