<?php
session_start();
include_once('../../config.php');
$mail = include '../../mailer.php';

// Configuração para exibição de erros (para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required_fields = ['id', 'status'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "O campo {$field} é obrigatório."]);
            exit;
        }
    }

    $id = $_POST['id'];
    $status = $_POST['status'];

    // Atualizar o status no banco de dados
    $query_update = "UPDATE tb_servicos_contratados SET status = ? WHERE id = ?";
    $stmt_update = $mysqli->prepare($query_update);
    $stmt_update->bind_param('si', $status, $id);
    if ($stmt_update->execute()) {
        // Se o status for cancelado, enviar email de notificação
        if ($status == 'cancelado') {
            // Recuperar informações do serviço e do consumidor
            $query_info = "SELECT sc.user_id, u.email, u.nome, s.titulo 
                           FROM tb_servicos_contratados sc
                           INNER JOIN tb_cadastro_users u ON sc.user_id = u.id
                           INNER JOIN tb_cad_servico_dev s ON sc.service_id = s.id
                           WHERE sc.id = ?";
            $stmt_info = $mysqli->prepare($query_info);
            $stmt_info->bind_param('i', $id);
            $stmt_info->execute();
            $stmt_info->bind_result($user_id, $email, $nome, $titulo_servico);
            $stmt_info->fetch();
            $stmt_info->close();

            if ($email) {
                try {
                    // Ajuste para UTF-8 no assunto e corpo do e-mail
                    $mail->CharSet = 'UTF-8';

                    // Configurações do email para o consumidor
                    $mail->setFrom('ondev.org@gmail.com', 'Ondev');
                    $mail->addAddress($email);
                    $mail->Subject = 'Serviço Cancelado';
                    $mail->isHTML(true);
                    $mail->Body = "
                    <html>
                    <head>
                        <style>
                            .email-container { font-family: Arial, sans-serif; }
                            .email-header { background-color: #f8f8f8; padding: 10px; text-align: center; }
                            .email-body { margin: 20px; }
                            .service-details { border: 1px solid #ddd; padding: 10px; margin-top: 20px; }
                        </style>
                    </head>
                    <body class='email-container'>
                        <div class='email-header'>
                            <h1>Serviço Cancelado</h1>
                        </div>
                        <div class='email-body'>
                            <p>O serviço <strong>{$titulo_servico}</strong> foi cancelado pelo desenvolvedor.</p>
                            <p>Se você tiver alguma dúvida, entre em contato conosco.</p>
                        </div>
                    </body>
                    </html>";

                    $mail->send();
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => "Erro ao enviar o e-mail de notificação. Mailer Error: {$mail->ErrorInfo}"]);
                    exit;
                }
            }
        }

        echo json_encode(['success' => true, 'message' => 'Status atualizado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o status no banco de dados.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitação inválido.']);
}
?>
