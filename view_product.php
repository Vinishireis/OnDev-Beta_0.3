<?php
// Iniciar a sessão
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Inclua o arquivo de configuração do banco de dados
    include_once('login_new/config.php');

    // Recupere o ID do usuário da sessão
    $user_id = $_SESSION['id'];
    $user_nome = $_SESSION['nome'];

    // Consulta SQL para recuperar os dados do usuário, incluindo a foto de perfil
    $query = "SELECT id, foto_perfil FROM tb_cadastro_users WHERE id = $user_id";
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
} else {
    echo "Usuário não está logado.";
    exit;
}

// Recupere o ID do serviço e o ID do desenvolvedor da URL
$servico_id = isset($_GET['service_id']) ? $_GET['service_id'] : null;
$developer_id = isset($_GET['developer_id']) ? $_GET['developer_id'] : null;

// Verifica se o ID do serviço foi fornecido
if ($servico_id === null || $developer_id === null) {
    echo "ID do serviço ou desenvolvedor não fornecido.";
    exit;
}

// Consulta SQL para recuperar os dados do serviço
$query = "SELECT * FROM tb_cad_servico_dev WHERE id = ?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $servico_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Verifica se o serviço foi encontrado
if ($row = mysqli_fetch_assoc($result)) {
    $titulo = isset($row['titulo']) ? $row['titulo'] : '';
    $descricao = isset($row['descricao']) ? $row['descricao'] : '';
    $instrucao = isset($row['instrucao']) ? $row['instrucao'] : '';
    $categoria = isset($row['categoria']) ? $row['categoria'] : '';
    $valor = isset($row['valor']) ? $row['valor'] : '';
    $tempo = isset($row['tempo']) ? $row['tempo'] : '';
    $img = isset($row['img']) ? $row['img'] : '';
} else {
    echo "Serviço não encontrado.";
    exit;
}

// Consulta SQL para recuperar os dados do desenvolvedor
$query_developer = "SELECT nome, sobrenome, foto_perfil FROM tb_cadastro_developer WHERE id = ?";
$stmt_developer = mysqli_prepare($mysqli, $query_developer);
mysqli_stmt_bind_param($stmt_developer, "i", $developer_id);
mysqli_stmt_execute($stmt_developer);
$result_developer = mysqli_stmt_get_result($stmt_developer);

// Verifica se o desenvolvedor foi encontrado
if ($row_developer = mysqli_fetch_assoc($result_developer)) {
    $nome_developer = isset($row_developer['nome']) ? $row_developer['nome'] : '';
    $sobrenome = isset($row_developer['sobrenome']) ? $row_developer['sobrenome'] : '';
    $foto_perfil = isset($row_developer['foto_perfil']) ? $row_developer['foto_perfil'] : '';
} else {
    echo "Desenvolvedor não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?></title>
    <link rel="stylesheet" href="./assets/css/style_view.css">
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($titulo) ?></h1>

        <div class="service-details">
            <img src="<?= htmlspecialchars($img) ?>" alt="Imagem do serviço">
            <div class="details">
                <h2>Descrição</h2>
                <p><?= nl2br(htmlspecialchars($descricao)) ?></p>
                <h2>Instruções</h2>
                <p><?= nl2br(htmlspecialchars($instrucao)) ?></p>
                <h2>Categoria</h2>
                <p><?= htmlspecialchars($categoria) ?></p>
                <h2>Tempo para Entrega</h2>
                <p><?= htmlspecialchars($tempo) ?> dias</p>
                <h2 class="price">Preço: R$ <?= htmlspecialchars($valor) ?></h2>
                <button id="contratar-btn" class="btn">Contratar Serviço</button>
                <button id="save-service-btn" class="btn">Salvar</button>
            </div>
        </div>

        <div class="developer-details">
            <img src="assets/img/users/<?= htmlspecialchars($foto_perfil) ?>" alt="Foto do desenvolvedor" class="profile-pic">
            <div class="details">
                <h2>Sobre o Desenvolvedor</h2>
                <p><strong>Nome:</strong> <?= htmlspecialchars($nome_developer) ?></p>
                <p><strong>Biografia:</strong> <?= nl2br(htmlspecialchars($sobrenome)) ?></p>
                <button id="favorite-developer-btn" class="btn">Favoritar</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Contratar Serviço</h2>
            <div class="modal-images">
                <img src="<?= htmlspecialchars($img) ?>" alt="Imagem do serviço" class="modal-img">
                <img src="assets/img/users/<?= htmlspecialchars($foto_perfil) ?>" alt="Foto do desenvolvedor" class="modal-img">
            </div>
            <table>
                <tr>
                    <td>Descrição</td>
                    <td><?= nl2br(htmlspecialchars($descricao)) ?></td>
                </tr>
                <tr>
                    <td>Instruções</td>
                    <td><?= nl2br(htmlspecialchars($instrucao)) ?></td>
                </tr>
                <tr>
                    <td>Categoria</td>
                    <td><?= htmlspecialchars($categoria) ?></td>
                </tr>
                <tr>
                    <td>Tempo para Entrega</td>
                    <td><?= htmlspecialchars($tempo) ?> dias</td>
                </tr>
                <tr>
                    <td>Preço</td>
                    <td>R$ <?= htmlspecialchars($valor) ?></td>
                </tr>
            </table>
            <h2>Sobre o Desenvolvedor</h2>
            <table>
                <tr>
                    <td>Nome</td>
                    <td><?= htmlspecialchars($nome_developer) ?></td>
                </tr>
                <tr>
                    <td>Biografia</td>
                    <td><?= nl2br(htmlspecialchars($sobrenome)) ?></td>
                </tr>
            </table>
            <form id="contratarForm" method="POST" action="enviar_email.php">
                <label for="nome">Nome:</label><br>
                <input type="text" id="nome" name="nome" required><br>
                <label for="contato">Contato:</label><br>
                <input type="text" id="contato" name="contato" required><br>
                <label for="informacoes">Informações adicionais:</label><br>
                <textarea id="informacoes" name="informacoes" required></textarea><br>
                <input type="hidden" id="service_id" name="service_id" value="<?= isset($servico_id) ? htmlspecialchars($servico_id) : '' ?>">
                <input type="hidden" id="user_id" name="user_id" value="<?= isset($user_id) ? htmlspecialchars($user_id) : '' ?>">
                <input type="hidden" id="developer_id" name="developer_id" value="<?= isset($developer_id) ? htmlspecialchars($developer_id) : '' ?>">
                <button type="button" id="enviarFormulario" class="btn">Enviar</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('enviarFormulario').addEventListener('click', function() {
            var enviarBtn = document.getElementById('enviarFormulario');
            enviarBtn.disabled = true; // Desativar o botão
            enviarBtn.textContent = 'Aguarde...'; // Alterar o texto do botão

            var nome = document.getElementById('nome').value;
            var contato = document.getElementById('contato').value;
            var informacoes = document.getElementById('informacoes').value;
            var serviceId = document.getElementById('service_id').value;
            var userId = document.getElementById('user_id').value;
            var developerId = document.getElementById('developer_id').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'enviar_email.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    enviarBtn.disabled = false; // Reativar o botão após a resposta do servidor
                    enviarBtn.textContent = 'Enviar'; // Restaurar o texto do botão
                    if (xhr.status == 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                window.location.href = 'success_page.php'; // Substitua com a página de sucesso
                            } else {
                                alert(response.message);
                            }
                        } catch (e) {
                            alert('Erro ao processar a resposta do servidor.');
                            console.error(e);
                        }
                    } else {
                        alert('Erro na requisição. Status: ' + xhr.status);
                    }
                }
            };

            var formData = 'nome=' + encodeURIComponent(nome) +
                '&contato=' + encodeURIComponent(contato) +
                '&informacoes=' + encodeURIComponent(informacoes) +
                '&service_id=' + encodeURIComponent(serviceId) +
                '&user_id=' + encodeURIComponent(userId) +
                '&developer_id=' + encodeURIComponent(developerId);
            xhr.send(formData);
        });

        var modal = document.getElementById('modal');
        var btn = document.getElementById("contratar-btn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        document.getElementById('save-service-btn').addEventListener('click', function() {
            var serviceId = <?= $servico_id ?>;
            console.log("Salvando serviço com ID:", serviceId);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'assets/php/salvar_servico.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    if (xhr.responseText === 'Serviço salvo com sucesso.') {
                        document.getElementById('save-service-btn').textContent = 'Salvo';
                    }
                }
            };
            xhr.send('service_id=' + serviceId);
        });

        document.getElementById('favorite-developer-btn').addEventListener('click', function() {
            var developerId = <?= $developer_id ?>;
            console.log("Favoritando desenvolvedor com ID:", developerId);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'assets/php/favoritar_developer.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    if (xhr.responseText === 'Desenvolvedor favoritado com sucesso.') {
                        document.getElementById('favorite-developer-btn').textContent = 'Favorito';
                    }
                }
            };
            xhr.send('developer_id=' + developerId);
        });
    </script>
</body>

</html>