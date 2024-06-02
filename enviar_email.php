<?php
session_start();
include_once('./login_new/config.php');
$mail = include './login_new/mailer.php';

// Configuração para exibição de erros (para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se todos os campos necessários foram recebidos
    $required_fields = ['nome', 'contato', 'informacoes', 'service_id', 'user_id', 'developer_id'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "O campo {$field} é obrigatório."]);
            exit;
        }
    }

    // Recuperar os dados recebidos do formulário
    $nome = $_POST['nome'];
    $contato = $_POST['contato'];
    $informacoes = $_POST['informacoes'];
    $service_id = $_POST['service_id'];
    $user_id = $_POST['user_id'];
    $developer_id = $_POST['developer_id'];

    // Recuperar o email do desenvolvedor
    $sql = "SELECT email FROM tb_cadastro_developer WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $developer_id);
    $stmt->execute();
    $stmt->bind_result($email_developer);
    $stmt->fetch();
    $stmt->close();

    // Recuperar o email do consumidor
    $sql_consumer = "SELECT email FROM tb_cadastro_users WHERE id = ?";
    $stmt_consumer = $mysqli->prepare($sql_consumer);
    $stmt_consumer->bind_param("i", $user_id);
    $stmt_consumer->execute();
    $stmt_consumer->bind_result($email_consumer);
    $stmt_consumer->fetch();
    $stmt_consumer->close();

    if ($email_developer && $email_consumer) {
        try {
            // Configurações do email para o desenvolvedor
            $mail->setFrom('ondev.org@gmail.com', 'Ondev');
            $mail->addAddress($email_developer);
            $mail->Subject = 'Solicitação de Contratação de Serviço';
            $mail->Body = "Você recebeu uma nova solicitação de contratação. Nome: {$nome}, Contato: {$contato}, Informações adicionais: {$informacoes}";
            $mail->send();

            // Email de confirmação para o consumidor
            $mail->clearAddresses();
            $mail->addAddress($email_consumer);
            $mail->Subject = 'Confirmação de Solicitação de Serviço';
            $mail->Body = "Sua solicitação de contratação foi enviada com sucesso.";
            $mail->send();

            echo json_encode(['success' => true, 'message' => 'Solicitação enviada com sucesso.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Erro ao enviar a solicitação. Mailer Error: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Desenvolvedor ou consumidor não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitação inválido.']);
}
?>
