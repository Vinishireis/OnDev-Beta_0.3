<?php
session_start();
include_once '../../config.php';
date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['serviceId']) && isset($_POST['avaliacao']) && isset($_POST['comentario'])) {
    $serviceId = filter_input(INPUT_POST, 'serviceId', FILTER_VALIDATE_INT);
    $avaliacao = filter_input(INPUT_POST, 'avaliacao', FILTER_SANITIZE_STRING);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
    $userId = $_SESSION['id'];

    if ($serviceId && $avaliacao && $comentario && $userId) {
        $query_developer = "SELECT id_developer FROM tb_cad_servico_dev WHERE id = ?";
        $stmt_developer = $mysqli->prepare($query_developer);
        $stmt_developer->bind_param("i", $serviceId);
        $stmt_developer->execute();
        $result_developer = $stmt_developer->get_result();
        $row_developer = $result_developer->fetch_assoc();
        $developerId = $row_developer['id_developer'];

        if ($developerId) {
            $query = "INSERT INTO tb_avaliacoes (service_id, user_id, developer_id, avaliacao, comentario) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("iiiss", $serviceId, $userId, $developerId, $avaliacao, $comentario);

            if ($stmt->execute()) {
                echo "<p style='color: green;'>Sucesso: Avaliação cadastrada com sucesso.</p>";
            } else {
                echo "<p style='color: #f00;'>Erro: Avaliação não cadastrada.</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color: #f00;'>Erro: Desenvolvedor não encontrado.</p>";
        }

        $stmt_developer->close();
    } else {
        echo "<p style='color: #f00;'>Erro: Dados inválidos.</p>";
    }
} else {
    echo "<p style='color: #f00;'>Erro: Dados não enviados.</p>";
}
?>