<?php
// Inclui o arquivo config.php para obter a conexão com o banco de dados
include 'config.php';

// Inicia a sessão
session_start();

// Definir valores padrão
$caminho_imagem = 'assets/img/users/profile_padrao.png';
$nome = 'Convidado';
$tipo_usuario = null;

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
	$id = (int)$_SESSION['id']; // Cast para inteiro para segurança
	$sql = "
        SELECT 'user' AS tipo, id, foto_perfil, nome FROM tb_cadastro_users WHERE id = ?
        UNION ALL
        SELECT 'developer' AS tipo, id, foto_perfil, nome FROM tb_cadastro_developer WHERE id = ?
    ";

	if ($stmt = $mysqli->prepare($sql)) {
		$stmt->bind_param('ii', $id, $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($row = $result->fetch_assoc()) {
			$tipo_usuario = $row['tipo'];
			$id = $row['id'];
			$foto_nome = $row['foto_perfil'];
			$nome = $row['nome'];
			$caminho_imagem = "assets/img/users/$foto_nome";
		} else {
			echo "Erro ao recuperar os dados do banco de dados.";
			exit;
		}
		$stmt->close();
	} else {
		echo "Erro ao preparar a consulta SQL: " . $mysqli->error;
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">

    <!--=============== REMIXICONS ===============-->
    <link rel="icon" href="assets\img\favicon\logo-oficial.svg" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assets\img\favicon\logo-oficial.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-700.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-600.woff2" as="font" type="font/woff2" crossorigin>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/style-plans.css">
    <link rel="preload" href="assets/fonts/material-icons/material-icons.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/material-icons/material-icons-outlined.woff2" as="font" type="font/woff2" crossorigin>

    <title>OnDev</title>
</head>

<body>

    <main class="main">

        <div class="main-inner">

            <!-- Begin mobile main menu -->
            <nav class="mmm">
                <div class="mmm-content">
                    <ul class="mmm-list">
                        <li>
                            <a href="index.php">Início</a>
                        </li>
                        <li>
                            <a href="about-us.php"> Sobre Nós</a>
                        </li>
                        <li>
                            <a href="services.php">Serviços</a>
                        </li>
                        <li>
                            <a href="plans.php">Planos</a>
                        </li>
                        <li>
                            <a href="news.php">Novidades</a>
                        </li>
                        <li>
                            <a href="contacts.php">Contato</a>
                        </li>
                        <li>
                            <div class="btn-group intro-btns">
                                <a href="login.php" class="btn btn-border btn-with-icon btn-small ripple">
                                    <span>Login</span>
                                    <svg class="btn-icon-right" viewBox="0 0 13 9" width="13" height="9">
                                        <use xlink:href="assets/img/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                                <a href="login_colaborator.php" class="btn btn-border btn-with-icon btn-small ripple">
                                    <span>Prestador</span>
                                    <svg class="btn-icon-right" viewBox="0 0 13 9" width="14" height="9">
                                        <use xlink:href="assets/img/sprite.svg#arrow-right"></use>
                                    </svg>
                                </a>
                            </div>
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
            <li><a href="index.php" data-title="Início"><span>Início</span></a></li>
            <li><a href="about-us.php" data-title="Sobre Nós"><span>Sobre Nós</span></a></li>
            <li><a href="services.php" data-title="Serviços"><span>Serviços</span></a></li>
            <li><a href="plans.php" data-title="Planos"><span>Planos</span></a></li>
            <li><a href="news.php" data-title="Novidades"><span>Novidades</span></a></li>
            <li><a href="contacts.php" data-title="Contato"><span>Contato</span></a></li>
            <?php if (isset($_SESSION['id'])) : ?>
                <li>
                    <div class="profile-dropdown">
                        <div class="profile-dropdown-btn" onclick="toggleDesktopDropdown()">
                            <div class="profile-img" style="background-image: url('<?php echo htmlspecialchars($caminho_imagem, ENT_QUOTES, 'UTF-8'); ?>');"></div>
                            <span><?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?> <i class="fa-solid fa-angle-down"></i></span>
                        </div>
                        <ul class="profile-dropdown-list">
                            <li class="profile-dropdown-list-item">
                                <a href="<?php echo ($tipo_usuario === 'developer') ? 'alterar_dados_dev.php' : 'alterar_dados.php'; ?>">
                                    <i class="fa-regular fa-user"></i> Editar Perfil
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="<?php echo ($tipo_usuario === 'developer') ? 'config_developer.php' : 'configuracoes_user.php'; ?>">
                                    <i class="fa-solid fa-sliders"></i> Configurações
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="generate.php" onclick="openModal(event)">
                                    <i class="fa fa-qrcode"></i> Login via QR Code
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="contacts.php">
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
                <li><a href="login.php" data-title="Login"><span>Login</span></a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <!-- End main menu -->

    <!-- Modal -->
    <div id="qrCodeModal" class="modal">
        <div class="modal-content">
            <p>Scaneie o QR Code para fazer Login</p>
            <span class="close" onclick="closeModal()">&times;</span>
            <iframe src="generate.php" frameborder="0" style="width:100%; height:400px;"></iframe>
        </div>
    </div>
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

            <!-- Begin bread crumbs -->
            <nav class="bread-crumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="bread-crumbs-list">
                                <li>
                                    <a href="index.php">Início</a>
                                    <i class="material-icons md-18">chevron_right</i>
                                </li>
                                <li>Serviços</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- End bread crumbs -->

            <div class="section">
                <div class="container">
                    <div class="row items">
                        <header class="col-12">
                            <div class="section-heading heading-center">
                                <div class="section-subheading">Descubra</div>
                                <h1>Nossos Serviços</h1>
                            </div>
                        </header>
                        <div class="col-12 item">
                            <div class="row items">
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">corporate_fare</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">corporate_fare</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Soluções Corporativas</h2>
                                        <div class="iitem-desc">Na OnDev, nós abraçamos o desenvolvimento holístico e apoio aos colaboradores com o objetivo.</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">web_services</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">web</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Soluções Web</h2>
                                        <div class="iitem-desc">Aproveite a aprendizagem experiencial integrada em muitos programas.</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">cloud_done</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">cloud_done</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Desenvolvimento de Nuvem</h2>
                                        <div class="iitem-desc">Através de uma combinação única de engenharia, construção e design.</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">laptop_mac</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">laptop_mac</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Aplicativos IOS/MacOS</h2>
                                        <div class="iitem-desc">Você pode trabalhar em laboratórios dentro e fora do campus ou até passar semestres no exterior.</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">phone_android</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">phone_android</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Aplicativos Android</h2>
                                        <div class="iitem-desc">Na OnDev, nós abraçamos o desenvolvimento holístico e apoio aos colaboradores com o objetivo.</div>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xl-4 col-12 item">
                                    <a href="single-service.php" class="iitem item-style iitem-hover">
                                        <div class="iitem-icon">
                                            <i class="material-icons material-icons-outlined md-48">tv</i>
                                        </div>
                                        <div class="iitem-icon-bg">
                                            <i class="material-icons material-icons-outlined">tv</i>
                                        </div>
                                        <h2 class="iitem-heading item-heading-large">Design de UI/UX</h2>
                                        <div class="iitem-desc">Aproveite a aprendizagem experiencial integrada em muitos programas.</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bff">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="bff-container">
                                <p>OnDev <br class="d-sm-none"> Conheça os nossos</p>
                                <div class="btn-group justify-content-center justify-content-md-start">
                                    <a href="services.php" class="btn btn-border btn-with-icon btn-small ripple">
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
                                        <a href="index.php" class="logo" title="OnDev">
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
                                        <li><a href="terms-and-conditions.php">Termos e Condições</a></li>
                                        <li><a href="privacy-policy.php">Política de Privacidade</a></li>
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
    <script src="assets/js/script.js"></script>
</body>

</html>