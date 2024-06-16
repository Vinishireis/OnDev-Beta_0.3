<?php
session_start();
include_once('../config.php');

// Inicializar variáveis
$tipo_selecionado = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$usuarios = [];

// Verificar se a conexão com o banco de dados foi estabelecida corretamente
if (!$mysqli) {
    die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
}

// Verificar se a requisição é do tipo POST e se os parâmetros necessários estão presentes
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo'])) {
    // Defina $tipo_selecionado com o valor recebido do formulário
    $tipo_selecionado = $_POST['tipo'];

    // Determinar o nome da tabela com base no tipo selecionado
    switch ($tipo_selecionado) {
        case 'usuario':
            $table_name = 'tb_cadastro_users';
            break;
        case 'desenvolvedor':
            $table_name = 'tb_cadastro_developer';
            break;
        case 'servico':
            $table_name = 'tb_cad_servico_dev';
            break;
        default:
            die('Tipo inválido selecionado');
    }

    // Executar consulta SQL para obter os registros
    $sql = "SELECT * FROM $table_name";
    $result = $mysqli->query($sql);

    if ($result) {
        // Converter resultado em array associativo
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Erro na consulta: " . $mysqli->error;
    }
}

// Fechar conexão com o banco de dados
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
    <style>
       /* Estilização dos botões de ação */
       .btn {
            border-radius: 50px;
            position: relative;
            display: inline-block;
            padding: 8px 16px;
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
            text-decoration: none;
            color: #fff;
            background-color: #e74c3c; /* Cor vermelha */
            box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, .5),
                        -4px -4px 6px 0 rgba(116, 125, 136, .2), 
                        inset -4px -4px 6px 0 rgba(255, 255, 255, .5),
                        inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
        }

        .btn:after {
            position: absolute;
            content: " ";
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #c0392b; /* Cor vermelha mais escura */
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #c0392b; /* Fica mais escuro quando o mouse passa */
            color: #fff;
        }

        .btn:hover:after {
            transform: scale(1.1);
        }

        /* Estilização dos botões de ação azuis */
        .btn2 {
            border-radius: 50px;
            position: relative;
            display: inline-block;
            padding: 8px 16px;
            border: none;
            transition: all 0.3s ease;
            overflow: hidden;
            text-decoration: none;
            color: #fff;
            background-color: #3498db; /* Cor azul */
            box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, .5),
                        -4px -4px 6px 0 rgba(116, 125, 136, .2), 
                        inset -4px -4px 6px 0 rgba(255, 255, 255, .5),
                        inset 4px 4px 6px 0 rgba(116, 125, 136, .3);
        }

        .btn2:after {
            position: absolute;
            content: " ";
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #2980b9; /* Cor azul mais escura */
            transition: all 0.3s ease;
        }

        .btn2:hover {
            background: #2980b9; /* Fica mais escuro quando o mouse passa */
            color: #fff;
        }

        .btn2:hover:after {
            transform: scale(1.1);
        }

        /* Estilização para o botão de seleção */
        .button-select {
            text-decoration: none;
            background-color: #ffff;
        }

        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilos para dispositivos móveis */
        @media screen and (max-width: 600px) {
            th, td {
                font-size: 14px;
            }
        }

        /* Centralizar o botão de logout */
        .logout-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Painel de Administração</h1>
    <form action="" method="post">
        <label  for="tipo">Selecionar Tipo:</label>
        <select  class="button button-select" name="tipo" id="tipo">
            <option value="usuario" <?php echo ($tipo_selecionado === 'usuario') ? 'selected' : ''; ?>>Usuários</option>
            <option value="desenvolvedor" <?php echo ($tipo_selecionado === 'desenvolvedor') ? 'selected' : ''; ?>>Desenvolvedores</option>
            <option value="servico" <?php echo ($tipo_selecionado === 'servico') ? 'selected' : ''; ?>>Serviços</option>
        </select>
        <button class="btn2" type="submit">Selecionar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <?php if ($tipo_selecionado === 'usuario' || $tipo_selecionado === 'desenvolvedor'): ?>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Bloqueado</th>
                    <th>Ações</th>
                <?php elseif ($tipo_selecionado === 'servico'): ?>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Tempo</th>
                    <th>Categoria</th>
                    <th>ID Developer</th>
                    <th>Bloqueado</th>
                    <th>Ações</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (is_array($usuarios) && !empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <?php if ($tipo_selecionado === 'usuario' || $tipo_selecionado === 'desenvolvedor'): ?>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['sobrenome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                            <td><?php echo isset($usuario['ddd']) && isset($usuario['telefone']) ? 
                        "(" . htmlspecialchars($usuario['ddd']) . ") " . htmlspecialchars($usuario['telefone']) : ''; ?></td>
                          
                            <td><?php echo $usuario['bloqueado'] ? 'Sim' : 'Não'; ?></td>
                            <td>
                                <?php if ($usuario['bloqueado']): ?>
                                    <form action="adm_desbloquear.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                        <input type="hidden" name="tipo" value="<?php echo $tipo_selecionado; ?>">
                                        <button class="btn2" type="submit" onclick="return confirm('Tem certeza que deseja desbloquear este usuário?')">Desbloquear</button>
                                    </form>
                                <?php else: ?>
                                    <form action="adm_bloquear.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                        <input type="hidden" name="tipo" value="<?php echo $tipo_selecionado; ?>">
                                        <button class="btn" type="submit" onclick="return confirm('Tem certeza que deseja bloquear este usuário?')">Bloquear</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php elseif ($tipo_selecionado === 'servico'): ?>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['descricao']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['valor']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['tempo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['id_developer']); ?></td>
                            <td><?php echo $usuario['bloqueado'] ? 'Sim' : 'Não'; ?></td>
                            <td>
                                <?php if ($usuario['bloqueado']): ?>
                                    <form action="adm_desbloquear.php" method="post">
                                        <input   type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                        <button class="btn2" type="submit"  onclick="return confirm('Tem certeza que deseja desbloquear este serviço?')">Desbloquear</button>
                                    </form>
                                <?php else: ?>
                                    <form action="adm_bloquear.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                        <button class="btn" type="submit" onclick="return confirm('Tem certeza que deseja bloquear este serviço?')">Bloquear</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?php echo ($tipo_selecionado === 'usuario' || $tipo_selecionado === 'desenvolvedor') ? '4' : '3'; ?>">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="logout-container">
        <a class="btn" href="../logout.php">Logout</a>
    </div>

</body>
</html>
