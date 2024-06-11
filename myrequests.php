<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once('config.php');

    $id_usuario = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    $query = "SELECT id, foto_perfil FROM tb_cadastro_users WHERE id = $id_usuario";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $foto_nome = $row['foto_perfil'];
        $caminho_imagem = "assets/img/users/$foto_nome";
    } else {
        echo "Erro ao recuperar a foto de perfil do banco de dados.";
        exit;
    }

    $query = "SELECT s.id, s.titulo, s.descricao, s.instrucao, s.categoria, s.valor, s.tempo, s.img, 
    d.nome AS nome_developer, d.sobrenome AS sobrenome_developer
    FROM tb_cad_servico_dev AS s
    INNER JOIN wishlist AS w ON s.id = w.service_id
    INNER JOIN tb_cadastro_developer AS d ON s.id_developer = d.id
    WHERE w.user_id = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $query_contratados = "SELECT s.id, s.titulo AS titulo_servico, s.valor, s.tempo, sc.data_contratacao, 
d.nome AS nome_desenvolvedor, d.sobrenome AS sobrenome_desenvolvedor, sc.status
FROM tb_servicos_contratados AS sc
INNER JOIN tb_cad_servico_dev AS s ON sc.service_id = s.id
INNER JOIN tb_cadastro_developer AS d ON sc.developer_id = d.id
WHERE sc.user_id = ?";
    $stmt_contratados = mysqli_prepare($mysqli, $query_contratados);
    mysqli_stmt_bind_param($stmt_contratados, "i", $id_usuario);
    mysqli_stmt_execute($stmt_contratados);
    $result_contratados = mysqli_stmt_get_result($stmt_contratados);

    if (isset($_POST['serviceId']) && isset($_POST['avaliacao']) && isset($_POST['comentario'])) {
        $serviceId = $_POST['serviceId'];
        $avaliacao = $_POST['avaliacao'];
        $comentario = $_POST['comentario'];
        $userId = $_SESSION['id'];

        $query_developer = "SELECT id_developer FROM tb_cad_servico_dev WHERE id = ?";
        $stmt_developer = mysqli_prepare($mysqli, $query_developer);
        mysqli_stmt_bind_param($stmt_developer, "i", $serviceId);
        mysqli_stmt_execute($stmt_developer);
        $result_developer = mysqli_stmt_get_result($stmt_developer);
        $row_developer = mysqli_fetch_assoc($result_developer);
        $developerId = $row_developer['id_developer'];

        $query = "INSERT INTO tb_avaliacoes (service_id, user_id, developer_id, avaliacao, comentario) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($mysqli, $query);
        mysqli_stmt_bind_param($stmt, "iiiss", $serviceId, $userId, $developerId, $avaliacao, $comentario);

        if (mysqli_stmt_execute($stmt)) {
            echo "Avaliação enviada com sucesso!";
        } else {
            echo "Erro ao enviar a avaliação.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($mysqli);
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
    <meta name='robots' content='max-image-preview:large' />
    <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Feed" href="https://template.makedreamwebsite.com/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Make Dream Website &raquo; Comments Feed" href="https://template.makedreamwebsite.com/comments/feed/" />
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

        th,
        td {
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

        /* COMEÇO DO MODAL*/
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        button.avaliado {
            background-color: #4CAF50;
            color: white;
        }

        /* FÓRMULÁRIO DE AVALIAÇÕES*/

        /* Criar as variaveis com as cores */

        :root {
            --amarelo: #ffcc00;
            --cinza: #cccccc;
        }

        /* Não exebir o input radio */

        .estrelas input[type=radio] {
            display: none;
        }

        /* Criar as estrelas preenchidas de amarelo */
        .estrelas label i.opcao.fa:before {
            content: '\f005';
            color: var(--amarelo);
        }

        /* Atribuir o cinza nas estrelas, quando selecionar a estrela o cinza */

        .estrelas input[type=radio]:checked~label i.fa:before {
            color: var(--cinza)
        }


        .estrela-preenchida {
            color: var(--amarelo)
        }

        .estrela-vazia {
            color: var(--cinza)
        }
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
                <a href="dashuser.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Início</span>
                </a>
            </li>
            <li class="active">
                <a href="dash_servicos.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Meus Pedidos</span>
                </a>
            </li>
            <li>
                <a href="favorite_developer.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Meus Desenvolvedores</span>
                </a>
            </li>
            <li>
                <a href="wishlist.php">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Lista de desejos</span>
                </a>
            </li>
            <li>
                <a href="alterar_dados_user.php">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Meu Perfil</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Mensagens</span>
                </a>
            </li>

        </ul>
        <ul class="side-menu">
            <li>
                <a href="configuracoes_user.php">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Configurações</span>
                </a>
            </li>
            <li>
                <a href="login_new/logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
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
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categorias</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Buscar...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
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
                    <h1>Meus Pedidos</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="wishlist.php">Meus pedidos</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="dashuser.php">Início</a>
                        </li>
                    </ul>
                </div>
                <a href="index.php" class="btn-download">
                    <i class='bx bx-home'></i>
                    <span class="text">Voltar ao Início</span>
                </a>
            </div>
            <!-- LISTA DE SERVIÇOS -->
            <div class="container">
                <h1>Lista de pedidos</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Data de Contratação</th>
                            <th>Título do Serviço</th>
                            <th>Nome do Desenvolvedor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_contratados && mysqli_num_rows($result_contratados) > 0) {
                            while ($row = mysqli_fetch_assoc($result_contratados)) {
                                // Formatando a data de contratação
                                $data_contratacao_formatada = date('d/m/Y', strtotime($row['data_contratacao']));
                        ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $data_contratacao_formatada ?></td>
                                    <td><?= $row['titulo_servico'] ?></td>
                                    <td><?= $row['nome_desenvolvedor'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'concluído') { ?>
                                            <button onclick="abrirModalAvaliacao(<?= $row['id'] ?>)">Avaliar</button>
                                        <?php } else { ?>
                                            <button onclick="removerServico(<?= $row['id'] ?>)">Remover Serviço</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">Nenhum serviço contratado encontrado.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>

            <!-- Modal de Avaliação -->
            <div id="modalAvaliacao" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="fecharModalAvaliacao()">&times;</span>
                    <h2>Avaliar Serviço</h2>
                    <form id="formAvaliacao">
                        <input type="hidden" id="serviceId" name="serviceId">
                        <div class="estrelas">
                            <p>Selecione a quantidade de estrelas</p>
                            <input type="radio" name="avaliacao" id="vazio" value="" checked>
                            <label for="estrela_um"><i class="opcao fa"></i></label>
                            <input type="radio" name="avaliacao" id="estrela_um" value="Péssimo">
                            <label for="estrela_dois"><i class="opcao fa"></i></label>
                            <input type="radio" name="avaliacao" id="estrela_dois" value="Ruim">
                            <label for="estrela_tres"><i class="opcao fa"></i></label>
                            <input type="radio" name="avaliacao" id="estrela_tres" value="Bom">
                            <label for="estrela_quatro"><i class="opcao fa"></i></label>
                            <input type="radio" name="avaliacao" id="estrela_quatro" value="Ótimo">
                            <label for="estrela_cinco"><i class="opcao fa"></i></label>
                            <input type="radio" name="avaliacao" id="estrela_cinco" value="Excelente">
                        </div>
                        <textarea name="comentario" id="comentario" rows="4" cols="50" placeholder="Digite o seu comentário..."></textarea>
                        <br><br>
                        <button type="button" onclick="enviarAvaliacao()">Enviar</button>
                        <div id="mensagem"></div>
                    </form>
                </div>
            </div>
            <!-- Fim Modal de Avaliação -->
        </main>

        <script>
            function removerServico(id) {
                if (confirm('Tem certeza de que deseja remover este serviço?')) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'assets/php/remove_servico_user.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            console.log('Response:', xhr.responseText); // Verificar a resposta do servidor
                            console.log('Status:', xhr.status); // Verificar o status da requisição
                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                console.log('Response:', response); // Verificar a resposta do servidor
                                if (response === 'success') {
                                    // Atualizar a linha da tabela
                                    var row = document.getElementById('row_' + id);
                                    if (row) {
                                        row.remove();
                                    }
                                } else {
                                    alert('Erro ao cancelar o serviço: ' + response); // Exibir a mensagem de erro retornada pelo servidor
                                }
                            } else {
                                alert('Erro na requisição. Status: ' + xhr.status); // Exibir o status da requisição HTTP
                            }
                        }
                    };
                    xhr.send('id=' + id);
                }
            }

            /* COMEÇO MODAL */

            function abrirModalAvaliacao(serviceId) {
                document.getElementById('serviceId').value = serviceId;
                document.getElementById('modalAvaliacao').style.display = 'block';
            }

            function fecharModalAvaliacao() {
                document.getElementById('modalAvaliacao').style.display = 'none';
            }

            function enviarAvaliacao() {
                var serviceId = document.getElementById('serviceId').value;
                var avaliacao = document.querySelector('input[name="avaliacao"]:checked').value;
                var comentario = document.getElementById('comentario').value;
                var mensagem = document.getElementById('mensagem');

                if (!avaliacao || !comentario) {
                    mensagem.innerHTML = '<p style="color: #f00;">Erro: Todos os campos são obrigatórios.</p>';
                    return;
                }

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'assets/php/avaliacao_process.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = xhr.responseText;
                        mensagem.innerHTML = response.includes('Sucesso') ?
                            '<p style="color: green;">Avaliação enviada com sucesso!</p>' :
                            '<p style="color: #f00;">Erro ao enviar a avaliação.</p>';
                        if (response.includes('Sucesso')) {
                            fecharModalAvaliacao();
                            atualizarTabelaServicos();
                        }
                    }
                };
                xhr.send('serviceId=' + serviceId + '&avaliacao=' + avaliacao + '&comentario=' + encodeURIComponent(comentario));
            }
            /* FIM MODAL */
        </script>

        <script src="assets/js/dashboard.js"></script>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/lozad/lozad.min.js"></script>
        <script src="assets/libs/device/device.js"></script>
        <script src="assets/libs/spincrement/jquery.spincrement.min.js"></script>

</body>

</html>