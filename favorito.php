<?php
// Certifique-se de que você tem a sessão iniciada
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Inclua o arquivo de configuração do banco de dados
    include_once('login_new/config.php');

    // Recupere o ID do usuário da sessão
    $id_usuario = $_SESSION['id'];

    // Consulta SQL para recuperar os desenvolvedores favoritos do usuário
    $query_favoritos = "SELECT d.id, d.nome, d.sobrenome, d.foto_perfil
                        FROM favorite_developers AS fd
                        INNER JOIN tb_cadastro_developer AS d ON fd.developer_id = d.id
                        WHERE fd.user_id = ?";
    $stmt_favoritos = mysqli_prepare($mysqli, $query_favoritos);
    mysqli_stmt_bind_param($stmt_favoritos, "i", $id_usuario);
    mysqli_stmt_execute($stmt_favoritos);
    $result_favoritos = mysqli_stmt_get_result($stmt_favoritos);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenvolvedores Favoritos</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        td img {
            max-width: 100px;
            height: auto;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Desenvolvedores Favoritos</h1>

    <?php if (isset($result_favoritos) && mysqli_num_rows($result_favoritos) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row_favorito = mysqli_fetch_assoc($result_favoritos)) { ?>
                    <tr>
                        <td>
                            <?php
                            // Define o caminho completo da imagem
                            $caminho_imagem = "assets/img/users/" . $row_favorito['foto_perfil'];
                            // Verifica se o arquivo de imagem existe
                            if (file_exists($caminho_imagem)) {
                                // Exibe a imagem usando a tag <img>
                                echo "<img src='$caminho_imagem' alt='Foto de perfil'>";
                            } else {
                                // Se não houver foto de perfil, exibe uma imagem padrão
                                echo '<img src="caminho_da_imagem_padrao" alt="Foto de Perfil padrão">';
                            }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($row_favorito['nome']) ?></td>
                        <td><?= htmlspecialchars($row_favorito['sobrenome']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Nenhum desenvolvedor favorito encontrado.</p>
    <?php } ?>
</div>

</body>
</html>
