<?php
// Inclua o arquivo de configuração do banco de dados
include_once('login_new/config.php');




// Consulta SQL para recuperar todos os serviços
$query = "SELECT * FROM tb_cad_servico_dev";
$result = mysqli_query($mysqli, $query);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços Disponíveis</title>
    <style>
        .container {
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
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
            text-align: center;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .card h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .card p {
            font-size: 1em;
            margin: 10px 0;
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
        }
        .card .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Serviços Disponíveis</h1>
    <div class="grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <img src="<?= htmlspecialchars($row['img']) ?>" alt="Imagem do serviço">
                <h2><?= htmlspecialchars($row['titulo']) ?></h2>
                <h3>Categoria: <?= htmlspecialchars($row['categoria']) ?></h3>
                <p><?= htmlspecialchars($row['descricao']) ?></p>
                <p><?= htmlspecialchars($row['instrucao']) ?></p>
                <p class="price">R$ <?= htmlspecialchars($row['valor']) ?></p>
                <p>Prazo: <?= htmlspecialchars($row['tempo']) ?> dia(s)</p>
                <a href="view_product.php?service_id=<?= $row['id'] ?>&developer_id=<?= $row['id_developer'] ?>" class="btn">Contratar Serviço</a>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>