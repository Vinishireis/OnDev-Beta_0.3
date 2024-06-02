<?php
include 'config.php';

$login_sucesso = false; // Defina como falso por padrão
$login_erro = false; // Defina como falso por padrão

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = isset($_POST['email']) ? $mysqli->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if(strlen($email) == 0) {
        echo "Preencha seu e-mail";
    } else if (strlen($password) == 0) {
        echo "Preencha sua senha";
    } else {
        // Verifica o tipo de usuário selecionado
        if(isset($_POST['tipo_usuario']) && !empty($_POST['tipo_usuario'])) {
            $tipo_usuario = $mysqli->real_escape_string($_POST['tipo_usuario']);
    
            // Determina a tabela correta baseada no tipo de usuário selecionado
            $tabela = ($tipo_usuario == 'consumidor') ? 'tb_cadastro_users' : 'tb_cadastro_developer';
    
            // Busca o usuário pelo e-mail na tabela correta
            $sql_code = "SELECT * FROM $tabela WHERE email = '$email'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade == 1) {
                $usuario = $sql_query->fetch_assoc();
    
                // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
                if(password_verify($password, $usuario['password'])) {
                    if(!isset($_SESSION)) {
                        session_start();
                    }
                    
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome']; // Adicionando o nome completo à sessão
                    
                    // Redireciona para o painel correspondente
                    if ($tipo_usuario == 'desenvolvedor') {
                        header("Location: ..\dashboard.php");
                    } else {
                        header("Location: session.php");
                    }
                    $login_sucesso = true; // Defina como verdadeiro se o login for bem-sucedido
                } else {
                    $login_erro = true; // Defina como verdadeiro se as credenciais estiverem incorretas
                }
            } else {
                $login_erro = true; // Defina como verdadeiro se o usuário não for encontrado
            }
        } else {
            echo "Por favor, selecione o tipo de usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== REMIXICONS ===============-->
   <link rel="icon" href="assets\img\favicon\logo-oficial.svg" type="image/x-icon"> 
<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/login_styles.css">
<link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-700.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-600.woff2" as="font" type="font/woff2" crossorigin>
    
<!-- ===== Ícones do Iconscout ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ==== Link CSS Styles ==== -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alerts-css@1.0.2/assets/css/alerts-css.min.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.10/css/all.css'>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/style.css">

    <style>
        .container-alert {
            width: 500px;
            max-width: 100%;
            margin: 20px; /* Adicione margens para espaçamento */
            padding: 20px;
            box-sizing: border-box;
            position: fixed; /* Posicione o alerta de forma fixa na tela */
            top: 20px; /* Distância do topo */
            right: 20px; /* Distância da direita */
            z-index: 9999; /* Garanta que o alerta fique acima de outros elementos */
        }

        /* Estilos para as animações dos alertas */
        .alert {
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .alert-success {
            animation-name: alert-success-animation;
            background-color: #4CAF50; /* Cor verde */
            color: white;
        }

        .alert-danger {
            animation-name: alert-danger-animation;
            background-color: #f44336; /* Cor vermelha */
            color: white;
        }

        @keyframes alert-success-animation {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes alert-danger-animation {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
    </style>

    <title>Formulário de Login e Registro</title> 
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login Colaborador</span>

                <form method="post" action="#">
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Digite seu e-mail" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Digite sua senha" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="radio-field">
                        <input type="radio" id="consumidor" name="tipo_usuario" value="consumidor" checked>
                        <label class="consumer" for="consumidor" class="text">Consumidor</label>
                        <input type="radio" id="desenvolvedor" name="tipo_usuario" value="desenvolvedor">
                        <label class="developer" for="desenvolvedor" class="text">Desenvolvedor</label>
                    </div>

                    <div class="checkbox-text">
                    <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Lembrar-me</label>
                        </div>
                        
                        <a href="./rec_senha.php" class="text">Esqueceu a senha?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Login">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text">Não é membro?
                        <a href="./form2.php" class="text signup-link">Cadastre-se Agora</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php if($login_sucesso): ?>
    <div class="content" id="colors">
        <div class="container-alert">
            <div class="alert alert-success" style="animation-delay: .2s">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    Logado com sucesso!
                </div>
                <div class="alert-close">
                    <i class="far fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($login_erro): ?>
    <div class="content" id="colors">
        <div class="container-alert">
            <div class="alert alert-danger" style="animation-delay: .2s">
                <div class="alert-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="alert-content">
                    Usuário ou senha incorretos!
                </div>
                <div class="alert-close">
                    <i class="far fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ===== Scripts ===== -->
    <script src="https://cdn.jsdelivr.net/npm/@gustavoquinalha/buttons-css@1.0.2/assets/js/buttons.min.js"></script>
    <script src="assets/js/login_script.js"></script>
</body>
</html>
