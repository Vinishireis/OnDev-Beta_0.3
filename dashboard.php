<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
        
	
   <!--=============== REMIXICONS ===============-->
   <meta name='robots' content='max-image-preview:large'/>
   <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Feed" href="https://template.makedreamwebsite.com/feed/"/>
   <link rel="alt ernate" type="application/rss+xml" title="Make Dream Website &raquo; Comments Feed" href="https://template.makedreamwebsite.com/comments/feed/"/>
   <link rel="shortcut icon" href="assets/img/logo-oficial.png" type="image/x-icon" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-700.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-600.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/material-icons/material-icons.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/material-icons/material-icons-outlined.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-oF1dJQyKcgNYN32z0sgep5EaS0hJSsUJFw27QAsuV4/zmYGT81aN9+Bh0Gm7j3R3" crossorigin="anonymous">


   <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/style_dashboard.css">

  <title>OnDev</title> 
</head>

<body>

<main class="main">
        
        <div class="main-inner">

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
                        <?php if (!isset($_SESSION['id'])): ?>
                            <li><a href="login.php" data-title="Login"><span>Login</span></a></li>
                        <?php endif; ?>
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
                                    <img src="assets/img/logo-oficial.png" width="40" height="40" alt="OnDev">
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
                                            <?php if (isset($_SESSION['id'])): ?>
                                                <!-- Se o usuário estiver logado, exibe o nome do usuário e o botão de logout -->
                                                <li>
                                                    <div class="profile-dropdown">
                                                        <div onclick="toggle()" class="profile-dropdown-btn">
                                                            <div class="profile-img">
                                                                <img src="path_to_user_image.jpg" alt="Profile Image"> <!-- Substitua pelo caminho da imagem do usuário -->
                                                            </div>
                                                            <span><?php echo $nome; ?> <i class="fa-solid fa-angle-down"></i></span>
                                                        </div>
                                                        <ul class="profile-dropdown-list">
                                                            <li class="profile-dropdown-list-item">
                                                                <a href="dashuser.php">
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
                                            <?php else: ?>
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

<main class="profile-body">
    <div class="profile">
        <img src="" alt="Profile Picture">
        <h2>Felipe Ponce</h2>
        <button>Editar Perfil</button>
        <h4>Atividades</h4>
        <p>Projetos Realizados: 0</p>
        <p>Projetos em execução: 0</p>
        <p>Horas Trabalhadas: 0</p>
        <h4>Informação</h4>
        <p>Avaliações: 0</p>
        <p>Violações: 0</p>
        <p>Certificações: 0</p>
        <h6>Ultimo login há 4 horas</h6>
        <h6>Ingressou há 3 anos</h6>
        <ul>
            <li><a href="dashboard_meuserv.php" data-title="Login"><span>Meus Serviços</span></a></li>
            <li><a href="dash_servicos.php" data-title="Login"><span>Criar Serviço</span></a></li>
            <li><a href="favorite_developer.php" data-title="Login"><span>Clientes Favoritos</span></a></li>
            <li><a href="dashuser.php" data-title="Login"><span>Mensagens</span></a></li>
        </ul>
    </div>
    
    <div class="info">
        <table>
            <thead>
                <tr>
                    <th>Habilidades</th>
                    <th>Certificações</th>
                    <th>Projetos Trabalhados</th>
                    <th>Anos de experiência</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>WordPress</td>
                    <td>Alura</td>
                    <td>150 projetos</td>
                    <td>2 a 3 anos</td>
                </tr>
                <tr>
                    <td>Design Gráfico</td>
                    <td>AWS</td>
                    <td>190 projetos</td>
                    <td>4 a 6 anos</td>
                </tr>
            </tbody>
        </table>
        <h3>Sobre Mim:</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.</p>
        
        <h3>Histórico Freelancer:</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.</p>
        
        <h3>Certificações:</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.</p>
        
        <h3>Idiomas:</h3>
        <ul>
            <li>Português</li>
            <li>Inglês</li>
        </ul>

        <div class="container">
            <button id="createSkillButton">Criar Habilidade</button>
            <div id="skillForm" class="hidden">
                <input type="text" id="skillInput" placeholder="Digite sua habilidade">
                <button id="saveSkillButton">Salvar</button>
                <button id="cancelSkillButton">Não Salvar</button>
            </div>
            <ul id="skillsList"></ul>
        </div>
        
        <div class="share-panel">
            <a href="" target="blank" class="share-icon">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="" class="share-icon">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
</main>

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
<script src="assets/js/dashboard.js"></script>
	
</body></html>