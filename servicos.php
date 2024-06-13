<?php
// Inclua o arquivo de configuração do banco de dados
include_once('config.php');

// Inicie a sessão
session_start();

$user_id = null;
$user_cpf = null;
$is_logged_in = false;
$is_developer = false;
$nome = ''; // Valor padrão para $nome
$caminho_imagem = 'assets/img/users/profile_padrao.png'; // Valor padrão para $caminho_imagem

// Verifique se o usuário está logado
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $is_logged_in = true;

    // Verifique se o usuário é um consumidor na tabela tb_cadastro_users
    $query_check_user = "SELECT cpf, nome, caminho_imagem FROM tb_cadastro_users WHERE id = '$user_id'";
    $result_check_user = mysqli_query($mysqli, $query_check_user);

    if (mysqli_num_rows($result_check_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_check_user);
        $user_cpf = $user_data['cpf'];
        $nome = $user_data['nome'] ?? '';
        $caminho_imagem = $user_data['caminho_imagem'] ?? 'assets/img/users/profile_padrao.png';
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
}

// Consulta SQL para recuperar todos os serviços que não estão pausados
$query = "SELECT * FROM tb_cad_servico_dev WHERE status != 'pausado'";
$result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <link rel="icon" href="assets/img/favicon/logo-oficial.svg" type="image/x-icon">
    
    <!--=============== REMIX ICONS ===============-->
    <link rel="stylesheet" href="assets/css/servicos_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    
    <!--=============== CSS ===============-->
     <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/style.css">
    


    <title>Serviços Disponíveis</title>
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
                                        <li><a href="index.php" data-title="Início"><span>Início</span></a></li>
                                        <li><a href="about-us.php" data-title="Sobre Nós"><span>Sobre Nós</span></a></li>
                                        <li><a href="services.php" data-title="Serviços"><span>Serviços</span></a></li>
                                        <li><a href="plans.php" data-title="Planos"><span>Planos</span></a></li>
                                        <li><a href="news.php" data-title="Novidades"><span>Novidades</span></a></li>
                                        <li><a href="contacts.php" data-title="Contato"><span>Contato</span></a></li>
                                        <?php if (isset($_SESSION['id'])) : ?>
                                            <li>
											<?php if (isset($_SESSION['id'])) : ?>
											<!-- Se o usuário estiver logado, exibe o nome do usuário e o botão de logout -->
											<li>
												<div class="profile-dropdown">
													<div onclick="toggle()" class="profile-dropdown-btn">
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
											<!-- Se o usuário não estiver logado, exibe um menu genérico -->
											<li>
												<div class="profile-dropdown">
													<div onclick="toggle()" class="profile-dropdown-btn">
														<div class="profile-img" style="background-image: url('assets/img/users/profile_padrao.png');"></div>
														<span>Convidado <i class="fa-solid fa-angle-down"></i></span>
													</div>
													<ul class="profile-dropdown-list">
														<li class="profile-dropdown-list-item">
															<a href="login.php">
																<i class="fa-regular fa-user"></i> Login
															</a>
														</li>
														<li class="profile-dropdown-list-item">
															<a href="form2.php">
																<i class="fa-regular fa-user-plus"></i> Registrar
															</a>
														</li>
														<li class="profile-dropdown-list-item">
															<a href="./contacts.php">
																<i class="fa-regular fa-circle-question"></i> Ajuda e Suporte
															</a>
														</li>
													</ul>
												</div>
											</li>
										<?php endif; ?>
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
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="well well-sm">
            <strong>Display</strong>
            <div class="btn-group">
                <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"></span> Estilo Listagem</a>
                <a href="#" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span> Estilo Grade</a>
            </div>
        </div>
        <div id="products" class="row list-group">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
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
                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="<?= htmlspecialchars($row['img']) ?>" alt="Imagem do serviço">
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading"><?= htmlspecialchars($row['titulo']) ?></h4>
                            <p class="group inner list-group-item-text"><?= htmlspecialchars($row['descricao']) ?></p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">R$ <?= htmlspecialchars($row['valor']) ?></p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="view_product.php?service_id=<?= $row['id'] ?>&developer_id=<?= $row['id_developer'] ?>">Contratar Serviço</a>
                                </div>
                            </div>
                            <p class="developer">Desenvolvido por: <a href="favorito.php?developer_id=<?= $service_developer_id ?>">
                                    <?= htmlspecialchars($dev_data['nome']) ?>
                                </a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
	<script src="qrcode.min.js"></script>



    <script src="assets/js/script_servicos.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="assets/js/script.js"></script>

    </body>
</html>