<?php
// Inclui o arquivo config.php para obter a conexão com o banco de dados
include 'config.php';

// Atribua a conexão à variável $conn
$conn = $mysqli;

// Inicia a sessão
session_start();

$user_id = null;
$user_cpf = null;
$is_logged_in = false;
$is_developer = false;

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Atribui o valor da variável de sessão 'nome' à variável $nome
    $nome = $_SESSION['nome'];

    // Obtém o objeto mysqli da configuração
    $mysqli = include 'config.php';

    // Prepara a consulta SQL para buscar o perfil do usuário
    $id = $_SESSION['id']; // Armazena o valor em uma variável para segurança
    $sql = "SELECT id, foto_perfil FROM tb_cadastro_users tb_cadastro_developer WHERE id = $id";

    // Executa a consulta SQL
    $result = $mysqli->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $foto_nome = $row['foto_perfil'];
        $caminho_imagem = "assets/img/users/$foto_nome";
    } else {
        echo "Erro ao recuperar a foto de perfil do banco de dados.";
        exit;
    }
}

// Verifique se o usuário é um consumidor na tabela tb_cadastro_users
$query_check_user = "SELECT cpf FROM tb_cadastro_users WHERE id = '$user_id'";
$result_check_user = mysqli_query($mysqli, $query_check_user);

if (mysqli_num_rows($result_check_user) > 0) {
    $user_data = mysqli_fetch_assoc($result_check_user);
    $user_cpf = $user_data['cpf'];
} else {
    // Se o usuário não for encontrado na tabela de consumidores, considere-o não logado
    $is_logged_in = false;
}

// Verifique se o usuário é um desenvolvedor na tabela tb_cadastro_developer
if ($is_logged_in) {
    $query_check_dev = "SELECT cpf FROM tb_cadastro_developer WHERE id = '$user_id'";
    $result_check_dev = mysqli_query($mysqli, $query_check_dev);

    if (mysqli_num_rows($result_check_dev) > 0) {
        $is_developer = true;
    }
}

// Se o usuário é um desenvolvedor, redirecione para a página de acesso negado
if ($is_developer) {
    header("Location: acesso_negado.php");
    exit();
}

// Consulta SQL para recuperar todos os serviços que não estão pausados
$query = "SELECT * FROM tb_cad_servico_dev WHERE status != 'pausado'";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">


    <!--=============== REMIXICONS ===============-->
    <meta name='robots' content='max-image-preview:large' />
    <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Feed" href="https://template.makedreamwebsite.com/feed/" />
    <link rel="alt ernate" type="application/rss+xml" title="Make Dream Website &raquo; Comments Feed" href="https://template.makedreamwebsite.com/comments/feed/" />
    <link rel="shortcut icon" href="assets/img/logo-oficial.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-700.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-600.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/material-icons/material-icons.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/material-icons/material-icons-outlined.woff2" as="font" type="font/woff2" crossorigin>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_services_na.css">

    <title>OnDev</title>
</head>

<body>


    <!-- Begin mobile main menu -->
    <nav class="mmm">
        <div class="mmm-content">
            <ul class="mmm-list">
                <li><a href="index.php">Início</a></li>
                <li><a href="about-us.php">Sobre Nós</a></li>
                <li><a href="services.php">Serviços</a></li>
                <li><a href="plans.php">Planos</a></li>
                <li><a href="news.php">Novidades</a></li>
                <li><a href="contacts.php">Contato</a></li>

                <!-- Se o usuário não estiver logado, exibe o link de login -->
                <li>
                    <a href="login.php" data-title="Login">
                        <span>Login</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End mobile main menu -->


    <header class="header header-minimal">
        <nav class="header-fixed">
            <div class="container">
                <div class="row flex-nowrap align-items-center justify-content-between">
                    <div class="col-auto header-fixed-col logo-wrapper">
                        <a href="index.php" class="logo" title="OnDev">
                            <img src="assets/img/logo-oficial.png" class="enlarged-logo" alt="OnDev">
                        </a>
                    </div>

                    <div class="col-auto col-xl col-static header-fixed-col d-none d-xl-block">
                        <div class="row flex-nowrap align-items-center justify-content-end">
                            <div class="col header-fixed-col d-none d-xl-block col-static">

                                <!-- Begin main menu -->
                                <nav class="main-mnu">
                                    <ul class="main-mnu-list">
                                        <li>
                                            <a href="index.php" data-title="Início">
                                                <span>Início</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="about-us.php" data-title="Sobre Nós">
                                                <span>Sobre Nós</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="services.php" data-title="Serviços">
                                                <span>Serviços</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="plans.php" data-title="Planos">
                                                <span>Planos</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="news.php" data-title="Novidades">
                                                <span>Novidades</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="contacts.php" data-title="Contato">
                                                <span>Contato</span>
                                            </a>
                                        </li>
                                        <?php if (isset($_SESSION['id'])) : ?>
                                            <!-- Se o usuário estiver logado, exibe o nome do usuário e o botão de logout -->
                                            <li>
                                                <div class="profile-dropdown">
                                                    <div onclick="toggle()" class="profile-dropdown-btn">
                                                        <div class="profile-img" style="background-image: url('<?php echo $caminho_imagem; ?>');"></div>
                                                        <span><?php echo $nome; ?> <i class="fa-solid fa-angle-down"></i></span>
                                                    </div>
                                                    <ul class="profile-dropdown-list">
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="alterar_dados.php">
                                                                <i class="fa-regular fa-user"></i> Editar Perfil
                                                            </a>
                                                        </li>
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="#">
                                                                <i class="fa-regular fa-envelope"></i> Mensagens
                                                            </a>
                                                        </li>
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="dashboard.php">
                                                                <i class="fa-solid fa-chart-line"></i> Dashboard
                                                            </a>
                                                        </li>
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="#">
                                                                <i class="fa-solid fa-sliders"></i> Configurações
                                                            </a>
                                                        </li>
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="./contacts.php">
                                                                <i class="fa-regular fa-circle-question"></i> Ajuda e Suporte
                                                            </a>
                                                        </li>
                                                        <hr />
                                                        <li class="profile-dropdown-list-item">
                                                            <a href="logout.php">
                                                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        <?php else : ?>
                                            <!-- Se o usuário não estiver logado, exibe o link de login -->
                                            <li>
                                                <a href="login.php" data-title="Login">
                                                    <span>Login</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- End main menu -->
                    <div class="col-auto d-block d-xl-none header-fixed-col">
                        <div class="main-mnu-btn">
                            <span class="bar bar-1"></span>
                            <span class="bar bar-2"></span>
                            <span class="bar bar-3"></span>
                            <span class="bar bar-4"></span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!---PERFIL -->
    <section class="dashboard section">


                        <!-- INICIO DOS SERVIÇOS -->
                        <div class="containerServices">
                            <h1>Serviços Disponíveis</h1>

                            <div class="grid">
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    $service_developer_id = $row['id_developer'];

                                    // Recuperar o nome e CPF do desenvolvedor do serviço
                                    $query_check_dev_cpf = "SELECT nome, cpf FROM tb_cadastro_developer WHERE id = '$service_developer_id'";
                                    $result_check_dev_cpf = mysqli_query($mysqli, $query_check_dev_cpf);
                                    $dev_data = mysqli_fetch_assoc($result_check_dev_cpf);

                                    // Se o usuário logado tentar contratar seu próprio serviço, pule essa iteração
                                    if ($is_logged_in && $dev_data['cpf'] == $user_cpf) {
                                        continue;
                                    }
                                ?>
                                    <div class="card card-three-per-row">
                                        <img src="<?= htmlspecialchars($row['img']) ?>" alt="Imagem do serviço">
                                        <h2><?= htmlspecialchars($row['titulo']) ?></h2>
                                        <h3>Categoria: <?= htmlspecialchars($row['categoria']) ?></h3>
                                        <p><?= htmlspecialchars($row['descricao']) ?></p>
                                        <p><?= htmlspecialchars($row['instrucao']) ?></p>
                                        <p class="price">R$ <?= htmlspecialchars($row['valor']) ?></p>
                                        <p>Prazo: <?= htmlspecialchars($row['tempo']) ?> dia(s)</p>
                                        <p class="developer">Desenvolvido por: <a href="favorito.php?developer_id=<?= $service_developer_id ?>">
                                                <?= htmlspecialchars($dev_data['nome']) ?>
                                            </a></p>
                                        <a href="view_product.php?service_id=<?= $row['id'] ?>&developer_id=<?= $row['id_developer'] ?>" class="btn">Contratar Serviço</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- FIM DOS SERVIÇOS -->

    </section>

    </div>

    <div class="bff">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bff-container">
                        <p>OnDev <br class="d-sm-none"> Conheça os nossos</p>
                        <div class="btn-group justify-content-center justify-content-md-start">
                            <a href="services.html" class="btn btn-border btn-with-icon btn-small ripple">
                                <span>Serviços</span>
                                <svg class="btn-icon-right" viewBox="0 0 13 9" width="13" height="9">
                                    <use xlink:href="assets/img/sprite.svg#arrow-right"></use>
                                </svg>
                            </a>
                            <a href="#" class="btn btn-border btn-with-icon btn-small ripple">
                                <span>Colaboradores</span>
                                <svg class="btn-icon-right" viewBox="0 0 13 9" width="13" height="9">
                                    <use xlink:href="assets/img/sprite.svg#arrow-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin footer -->
    <footer class="footer footer-minimal">
        <div class="footer-main">
            <div class="container">
                <div class="row items align-items-center">
                    <div class="col-lg-3 col-md-4 col-12 item">
                        <div class="widget-brand-info">
                            <div class="widget-brand-info-main">
                                <a href="index.html" class="logo" title="OnDev">
                                    <img data-src="assets/img/logo-white.svg" class="lazy" width="133" height="36" src="assets/img/logo-oficial.png" alt="OnDev" data-loaded="true" style="opacity: 1;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md item">
                        <div class="footer-item">
                            <nav class="footer-nav">
                                <ul class="footer-mnu footer-mnu-line">
                                    <li><a href="#!" class="hover-link" data-title="Início"><span>Início</span></a></li>
                                    <li><a href="#!" class="hover-link" data-title="Sobre Nós"><span>Sobre Nós</span></a></li>
                                    <li><a href="#!" class="hover-link" data-title="Serviços"><span>Serviços</span></a></li>
                                    <li><a href="#!" class="hover-link" data-title="Novidades"><span>Novidades</span></a></li>
                                    <li><a href="#!" class="hover-link" data-title="Contato"><span>Contato</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row justify-content-between items">
                    <div class="col-md-auto col-12 item">
                        <nav class="footer-links">
                            <ul>
                                <li><a href="terms-and-conditions.html">Termos e Condições</a></li>
                                <li><a href="privacy-policy.html">Política de Privacidade</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-auto col-12 item">
                        <div class="copyright">© 2024 OnDev. All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End footer -->

    </main><!-- End main -->

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/lozad/lozad.min.js"></script>
    <script src="assets/libs/device/device.js"></script>
    <script src="assets/libs/spincrement/jquery.spincrement.min.js"></script>
    <script src="assets/libs/pristine/pristine.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/forms.js"></script>

</body>

</html>
<?php
// Fechar a conexão com o banco de dados
$mysqli->close();
?>