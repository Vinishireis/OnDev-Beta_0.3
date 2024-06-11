<?php
// Certifique-se de que você tem a sessão iniciada
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Inclua o arquivo de configuração do banco de dados
    include_once('config.php');

    // Recupere o ID do usuário da sessão
    $id_usuario = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    // Consulta SQL para recuperar os dados do usuário, incluindo a foto de perfil
    $query = "SELECT id, foto_perfil FROM tb_cadastro_developer WHERE id = $id_usuario";
    $result = mysqli_query($mysqli, $query);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
        // Extrai os dados da imagem do resultado da consulta
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $foto_nome = $row['foto_perfil'];
        
        // Define o caminho completo da imagem
        $caminho_imagem = "assets/img/users/$foto_nome";

    } else {
        // Em caso de erro na consulta
        echo "Erro ao recuperar a foto de perfil do banco de dados.";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--=============== REMIXICONS ===============-->
<meta name='robots' content='max-image-preview:large'/>
   <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Feed" href="https://template.makedreamwebsite.com/feed/"/>
   <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Comments Feed" href="https://template.makedreamwebsite.com/comments/feed/"/>
   <link rel="shortcut icon" href="assets/img/logo-oficial.png" type="image/x-icon" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/source-sans-pro-v21-latin/source-sans-pro-v21-latin-700.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-700.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/montserrat-v25-latin/montserrat-v25-latin-600.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/material-icons/material-icons.woff2" as="font" type="font/woff2" crossorigin>
   <link rel="preload" href="assets/fonts/material-icons/material-icons-outlined.woff2" as="font" type="font/woff2" crossorigin>

   <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="assets/css/dashboard_style.css">

   <title>OnDev Dashboard</title>
</head>
<body>


	<!-- SIDEBAR -->
    <section id="sidebar">
        <a href="index.html" class="brand">
            <img src="assets/img/logo-oficial.png">
        </a>    
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Início</span>
				</a>
			</li>
			<li>
				<a href="dash_servicos.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Criar Serviços</span>
				</a>
			</li>
			<li>
				<a href="dashviewserv.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Meus Serviços</span>
				</a>
			</li>
			<li>
				<a href="alterar_dados.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Meus Dados</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Mensagens</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Equipe</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Configurações</span>
				</a>
			</li>
			<li>
			<a href="login_new/logout.php" class="logout" >
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
<nav>
    <i class='bx bx-menu' ></i>
    <a href="#" class="nav-link">Categorias</a>
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Buscar...">
            <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
        </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>
    <a href="#" class="notification">
        <i class='bx bxs-bell' ></i>
        <span class="num">8</span>
    <a href="#" class="profile">
        <?php
			// Verifica se o arquivo de imagem existe
			if (file_exists($caminho_imagem)) {
				// Exibe a imagem usando a tag <img>
				echo "<img src='$caminho_imagem' alt='Foto de perfil'>";
			} else {
                // Se não houver foto de perfil, exibe uma imagem padrão
                echo '<img src="caminho_da_imagem_padrao" alt="Foto de Perfil padrão">';
            }
        ?>
    </a>
</nav>
<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Olá <?php echo $nome; ?>!</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Início</a>
						</li>
					</ul>
				</div>
				<a href="index.php" class="btn-download">
					<i class='bx bx-home' ></i>
					<span class="text">Voltar ao Início</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>20</h3>
						<p>Novos Pedidos</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitas</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>R$2543</h3>
						<p>Total de Contribuição</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Pedidos Recentes</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<td>
									<img src="assets/img/people.png">
									<p>Michael Smith</p>
								</td>
								<td>05-15-2020</td>
								<td><span class="status completed">Completo</span></td>
							</tr>
							<tr>
								<td>
									<img src="assets/img/people.png">
									<p>Emily Johnson</p>
								</td>
								<td>09-28-2022</td>
								<td><span class="status pending">Pendente</span></td>
							</tr>
							<tr>
								<td>
									<img src="assets/img/people.png">
									<p>David Brown</p>
								</td>
								<td>03-10-2023</td>
								<td><span class="status process">Em Processo</span></td>
							</tr>
							<tr>
								<td>
									<img src="assets/img/people.png">
									<p>Samantha Wilson</p>
								</td>
								<td>07-05-2023</td>
								<td><span class="status pending">Pendente</span></td>
							</tr>
							<tr>
								<td>
									<img src="assets/img/people.png">
									<p>Christopher Anderson</p>
								</td>
								<td>11-20-2024</td>
								<td><span class="status completed">Completo</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Anotar</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="lista-de-anotacoes">
						<!-- Aqui você pode adicionar suas anotações como itens de lista -->
						<li>Primeira anotação</li>
						<li>Segunda anotação</li>
						<li>Terceira anotação</li>
						<!-- Adicione quantas anotações desejar -->
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</div>
</div>

	</main><!-- End main -->

	
<script src="assets/js/dashboard.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/lozad/lozad.min.js"></script>
<script src="assets/libs/device/device.js"></script>
<script src="assets/libs/spincrement/jquery.spincrement.min.js"></script>

</body></html>