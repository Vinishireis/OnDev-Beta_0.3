<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Via QR Code</title>
</head>
<body>
    <?php 
    // Incluir os arquivos necessários
    require 'config.php';
    require 'Usuario.php';

    // Criar uma instância da classe Usuario
    $mysqli = include 'config.php';
    $usuario = new Usuario($mysqli);

    // Gerar o token QR
    $qrtoken = $usuario->createQR(1);
    ?>

    <!-- DRAW QR Code -->
    <div id="qrcode"></div>
    <script src="qrcode.min.js"></script>
    <script>
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "<?php echo $qrtoken; ?>",
            width: 440,
            height: 380,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>
</body>
</html>
