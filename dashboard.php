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

   <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <title>OnDev</title> 
  <style>
  .profile-body {
    display:flex;
    align-items: top;
    padding-top: 12px ;
        padding-left: 12px ; 
        padding-right: 12px ; 
        padding-bottom: 12px ;
  }
    .profile {
      width: 300px;
      border: 1px solid #ddd;
      padding: 20px;
      margin-right: 20px;
      background-color: #fff;
    }
    .profile img {
      width: 50%;
      height: 20%;
      border-radius: 50%;
    }
    .profile h2, .profile p {
      margin: 0 0 15px 0;
    }
    .info {
        width: 50%;
        height: 25%;
        border: 1px solid #ccc;
        border-radius: 1px;
        resize:vertical;
    }
    .info h2 {
      margin: 0 0 15px 0;
    }
    .info p {
      margin: 0 0 10px 0;
    }
    </style>

</head>

<body>

	<main class="main">
		
		<div class="main-inner">

			<!-- Begin mobile main menu -->
<nav class="mmm">
    <div class="mmm-content">
        <ul class="mmm-list">
            <li>
                <a href="index.html">Início</a>
            </li>
            <li>
                <a href="about-us.html"> Sobre Nós</a>
            </li>
            <li>
                <a href="services.html">Serviços</a>
            </li>
            <li>
                <a href="plans.html">Planos</a>
            </li>
            <li>
                <a href="news.html">Novidades</a>
            </li>
            <li>
                <a href="contacts.html">Contato</a>
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
                    <a href="index.html" class="logo" title="OnDev">
                        <img src="assets/img/logo-oficial.png" width="36" height="36" alt="OnDev">
                    </a>
                </div>
                <div class="col-auto col-xl col-static header-fixed-col d-none d-xl-block">
                    <div class="row flex-nowrap align-items-center justify-content-end">
                        <div class="col header-fixed-col d-none d-xl-block col-static">
                            <!-- Begin main menu -->
<nav class="main-mnu">
    <ul class="main-mnu-list">
        <li>
            <a href="index.html" data-title="Início">
                <span>Início</span>
            </a>
        </li>
        <li>
            <a href="about-us.html" data-title="Sobre Nós">
                <span>Sobre Nós</span>
            </a>
        </li>
        <li>
            <a href="services.html" data-title="Serviços">
                <span>Serviços</span>
            </a>
        </li>
        <li>
            <a href="plans.html" data-title="Planos">
                <span>Planos</span>
            </a>
        </li>
        <li>
            <a href="news.html" data-title="Novidades">
                <span>Novidades</span>
            </a>
        </li>
        <li>
            <a href="contacts.html" data-title="Contato">
                <span>Contato</span>
            </a>
        </li>
		<li>
		<?php if (isset($_SESSION['id'])): ?>
            <!-- Se o usuário estiver logado, exibe o nome do usuário e o botão de logout -->
            <li>
                <span><?php echo $nome; ?></span>
            </li>
            <li>
			<a href="login_new/logout.php" data-title="Logout">   
                    <span>Logout</span>
                </a>
            </li>
        <?php else: ?>
            <!-- Se o usuário não estiver logado, exibe o link de login -->
            <li>
                <a href=".\login_new\login.php" data-title="Login">
                    <span>Login</span>
                </a>
            </li>
			<li>
			<a href=".\login_new\login.php" data-title="Prestador">
				<span>Prestador</span>
			</a>
		</li>
        <?php endif; ?>
		
    </ul>
</nav>
<!-- End main menu -->
                        </div>
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
        <h6>Ultimo login  há 4 horas</h6>
        <h6>Ingressou  há 3 anos</h6>
        <li>
        <a href=".\dashboard_meuserv.php" data-title="Login">
                    <span>Meus Serviços</span>
                </a>
        </li>
              <li>  <a href=".\dash_servicos.php" data-title="Login">
                    <span>Criar Serviço</span>
                </a> </li> 
              <li>  <a href=".\favorite_developer.php" data-title="Login">
                    <span> Clientes Favoritos </span>
                </a> </li>
               <li> <a href=".\dashuser.php" data-title="Login">
                    <span>Mensagens</span>
        </a> </li>
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
    </tbody>
    </thead>
</table>
<h3>Sobre Mim:</h3>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.

        </p>
<h3>Historico Freelancer:</h3>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.
    
        </p>
<h3>Certificações:</h3>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde itaque architecto tenetur magni illum ut eius labore animi quam fugiat, vel adipisci aspernatur. Voluptates amet fugit cum, saepe labore officiis.
    
        </p>
<h3>Idiomas:</h3>
<p><li>
    Português
</li>
<li>
    Inglês
</li>
    
        </p>

            <div class="container">
        <button id="createSkillButton">Criar Habilidade</button>
        <div id="skillForm" class="hidden">
            <input type="text" id="skillInput" placeholder="Digite sua habilidade">
            <button id="saveSkillButton">Salvar</button>
            <button id="cancelSkillButton">Não Salvar</button>
        </div>
        <ul id="skillsList"></ul>
    </div>
    <style>


.hidden {
    display: none;
}

#skillForm {
    margin: 20px 0;
}

#skillsList {
    list-style-type: none;
    padding: 0;
}

#skillsList li {
    margin: 5px 0;
    padding: 10px;
    background-color: #e0e0e0;
    border-radius: 4px;
}
    </style>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const createSkillButton = document.getElementById('createSkillButton');
    const skillForm = document.getElementById('skillForm');
    const skillInput = document.getElementById('skillInput');
    const saveSkillButton = document.getElementById('saveSkillButton');
    const cancelSkillButton = document.getElementById('cancelSkillButton');
    const skillsList = document.getElementById('skillsList');

    let skillCount = 0;

    createSkillButton.addEventListener('click', () => {
        skillForm.classList.remove('hidden');
        skillInput.focus();
    });

    saveSkillButton.addEventListener('click', () => {
        const skillText = skillInput.value.trim();
        if (skillText !== '') {
            skillCount++;
            const listItem = document.createElement('li');
            listItem.textContent = `${skillText}`;
            skillsList.appendChild(listItem);
            skillInput.value = '';
            skillForm.classList.add('hidden');
        }
    });

    cancelSkillButton.addEventListener('click', () => {
        skillInput.value = '';
        skillForm.classList.add('hidden');
    });
});

    </script>
<div class="share-panel">
        <a href="https://wa.me/?text=Confira%20este%20site:%20https://www.seusite.com" target="_blank" class="share-icon">
            <img src="whatsapp.png" alt="Compartilhar no WhatsApp">
        </a>
        <a href="mailto:?subject=Confira%20este%20site&body=Veja%20este%20site:%20https://www.seusite.com" class="share-icon">
            <img src="o-email.png" alt="Compartilhar por E-mail">
        </a>
    </div>
    <style>
        .share-panel {
    position: fixed;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px 0 0 8px;
    padding: 10px;
    z-index: 1000;
}

.share-panel .share-icon {
    display: block;
    margin: 10px 0;
    text-align: center;
}

.share-panel .share-icon img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: transform 0.3s;
}

.share-panel .share-icon img:hover {
    transform: scale(1.1);
}
    </style>    








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
                    <div class="copyright">©️ 2024 OnDev. All rights reserved.</div>
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
	
</body></html>