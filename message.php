<?php 

// messages.php
session_start();
include_once('login_new/config.php');

$id_usuario = $_SESSION['id'];

$query = "SELECT * FROM tb_mensagens WHERE id_destinatario = ? ORDER BY data_envio DESC";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<h1>Minhas Mensagens</h1>
<ul>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <li>
        <p><strong>De:</strong> <?= htmlspecialchars($row['id_remetente']) ?></p>
        <p><strong>Mensagem:</strong> <?= nl2br(htmlspecialchars($row['mensagem'])) ?></p>
        <p><strong>Enviada em:</strong> <?= htmlspecialchars($row['data_envio']) ?></p>
    </li>
<?php } ?>
</ul>