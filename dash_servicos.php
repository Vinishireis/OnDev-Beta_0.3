<?php
// COMEÇO CABEÇALHO
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Inclua o arquivo de configuração do banco de dados
    include_once('config.php');

    // Recupere o ID do usuário da sessão
    $usuario_id = $_SESSION['id'];

    // Consulta SQL para verificar se o usuário está na tabela tb_cadastro_developer
    $query_developer = "SELECT id, foto_perfil FROM tb_cadastro_developer WHERE id = ?";
    $stmt_developer = mysqli_prepare($mysqli, $query_developer);
    mysqli_stmt_bind_param($stmt_developer, "i", $usuario_id);
    mysqli_stmt_execute($stmt_developer);
    $result_developer = mysqli_stmt_get_result($stmt_developer);

    // Verifica se o usuário está na tabela tb_cadastro_users
    $query_user = "SELECT id FROM tb_cadastro_users WHERE id = ?";
    $stmt_user = mysqli_prepare($mysqli, $query_user);
    mysqli_stmt_bind_param($stmt_user, "i", $usuario_id);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    // Se o usuário está na tabela tb_cadastro_users e não na tb_cadastro_developer, redireciona para 404
    if ($result_user->num_rows > 0 && $result_developer->num_rows === 0) {
        header("Location: 404.php");
        exit;
    }

    // Se o usuário está na tabela tb_cadastro_developer, prossegue
    if ($row = mysqli_fetch_assoc($result_developer)) {
        $id = $row['id'];
        $foto_nome = $row['foto_perfil'];
        $caminho_imagem = "assets/img/users/$foto_nome";
    } else {
        echo "Erro ao recuperar a foto de perfil do banco de dados.";
        exit;
    }
} else {
    // Usuário não está logado, redireciona para a página 404
    header("Location: login.php");
    exit;
}
// FIM CABEÇALHO

// Função para lidar com o upload da imagem
function uploadImagem($nomeCampo) {
    $diretorio = "assets/img/services/";
    $imagemNome = $_FILES[$nomeCampo]['name'];
    $imagemTmp = $_FILES[$nomeCampo]['tmp_name'];
    $caminhoImagem = $diretorio . basename($imagemNome);

    // Move a imagem para o diretório especificado
    if (move_uploaded_file($imagemTmp, $caminhoImagem)) {
        return $caminhoImagem;
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se foi enviada uma imagem
    if (isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
        $caminhoImagem = uploadImagem('img');
        if ($caminhoImagem === null) {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        $caminhoImagem = null; // Se nenhuma imagem foi enviada, mantém o campo como null
    }

    // Verifica se o id_developer é válido
    $query_check_developer = "SELECT id FROM tb_cadastro_developer WHERE id = ?";
    $stmt_check_developer = mysqli_prepare($mysqli, $query_check_developer);
    mysqli_stmt_bind_param($stmt_check_developer, "i", $usuario_id);
    mysqli_stmt_execute($stmt_check_developer);
    mysqli_stmt_store_result($stmt_check_developer);
    if (mysqli_stmt_num_rows($stmt_check_developer) == 0) {
        echo "ID de desenvolvedor inválido.";
        exit;
    }

    // Coletar os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $instrucao = $_POST['instrucao'];
    $categoria = $_POST['categoria'];
    $valor = $_POST['valor'];
    $tempo = $_POST['tempo'];

    // Prepara a consulta para inserir os dados na tabela
    $query_insert = "INSERT INTO tb_cad_servico_dev (titulo, descricao, instrucao, categoria, valor, tempo, img, id_developer) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($mysqli, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, 'ssssdisi', $titulo, $descricao, $instrucao, $categoria, $valor, $tempo, $caminhoImagem, $usuario_id);

    if (mysqli_stmt_execute($stmt_insert)) {
        header("Location: dashviewserv.php");
        exit;
    } else {
        echo "Erro ao cadastrar o serviço: " . mysqli_error($mysqli);
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
   <link rel="stylesheet" href="assets/css/dash_servicos_style.css">

   <title>OnDev Dashboard</title>
   <style> 
   
</style>
</head>
<body>


	<!-- SIDEBAR -->
    <section id="sidebar">
        <a href="index.php" class="brand">
            <img src="assets/img/logo-oficial.png">
        </a>    
		<ul class="side-menu top">
			<li>
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Início</span>
				</a>
			</li>
            <li>
                <a href="callings_dev.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Solicitações</span>
                </a>
            </li>
			<li class="active">
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
				<a href="alterar_dados_dev.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Meus Dados</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="config_developer.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Configurações</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
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
			</a>
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
					<h1>Cadastro de serviços</h1>
					<ul class="breadcrumb">
						<li>
							<a href="dash_servicos.php">Serviços</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="dashboard.php">Início</a>
						</li>
					</ul>
				</div>
				<a href="index.php" class="btn-download">
					<i class='bx bx-home' ></i>
					<span class="text">Voltar ao Início</span>
				</a>
			</div>
            <!-- ALTERAR DADOS-->
            </br>
            <div class="container">
                <h1>Criar Serviço</h1>

                <form action="dash_servicos.php" method="POST" enctype="multipart/form-data" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        <label for="titulo">Título do Serviço:</label>
        <input type="text" id="titulo" name="titulo" required>
        
        <label for="descricao">Descrição do Serviço:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>
        
        <label for="instrucoes">Instruções ao Comprador:</label>
        <textarea id="instrucao" name="instrucao" rows="4"></textarea>

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option disabled selected>Selecione a categoria</option>
            <option value="Sites">Desenvolvimento de sites</option>
            <option value="Mobile">App mobile</option>
            <option value="Design">Design gráfico</option>
            <!-- Adicione outras opções de categoria aqui -->
        </select>
        
        <label for="preco">Preço:</label>
        <input type="text" id="valor" name="valor" required oninput="formatarPreco(this)">
        
        <label for="tempo">Tempo para Entregar (Dias | mínimo 1 dia):</label>
        <input type="number" id="tempo" name="tempo" min="1" required>
        
        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="img" accept="image/*">
        
        <p>Após o envio, o seu serviço será analisado por um de nossos especialistas. Em caso de irregularidade, você receberá um e-mail para ser retificado ou na plataforma com as instruções a respeito do que deverá ser alterado. Caso o serviço enviado seja aprovado, você será notificado e o serviço será publicado.</p>
        
        <label for="termos">Ao criar o seu serviço você concorda com os <a href="#">Termos e Condições</a>.</label>
        <input type="checkbox" id="termos" required>
        <button type="submit">Criar Serviço</button>
    </form>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
</div>
</div>

	</main><!-- End main -->

	
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/script_preco.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/lozad/lozad.min.js"></script>
<script src="assets/libs/device/device.js"></script>
<script src="assets/libs/spincrement/jquery.spincrement.min.js"></script>

</body></html>