<?php
// Inclua o arquivo de configuração do banco de dados
include_once('config.php');

// Inicie a sessão
session_start();

$user_id = null;
$user_cpf = null;
$is_logged_in = false;
$is_developer = false;

// Verifique se o usuário está logado
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $is_logged_in = true;

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
    <title>Serviços Disponíveis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .containerServices {
            width: 90%;
            margin: auto;
            padding-top: 20px;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .card h2 {
            font-size: 1.5em;
            margin: 10px 0;
            color: #333;
        }

        .card h3 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #777;
        }

        .card p {
            font-size: 1em;
            margin: 10px 0;
            color: #555;
        }

        .card .price {
            font-size: 1.2em;
            color: #4CAF50;
            margin: 10px 0;
        }

        .card .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .card .btn:hover {
            background-color: #45a049;
        }

        .developer {
            margin-top: 10px;
            color: #555;
            font-size: 0.9em;
        }

        .developer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .developer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
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
                <div class="card">
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
</body>

</html>