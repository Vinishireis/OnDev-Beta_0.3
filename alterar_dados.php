<?php
session_start();

// Verificar se o usuário está logado, caso contrário, redirecioná-lo para a página de login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Incluir o arquivo de configuração do banco de dados
include_once('config.php');

// Obter o ID do usuário da sessão
$usuario_id = $_SESSION['id'];

// Definir a tabela como 'tb_cadastro_developer' porque este é o tipo de usuário correspondente
$tabela = 'tb_cadastro_developer';

// Verificar se o formulário foi enviado
if(isset($_POST['submit'])){
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ddd = $_POST['ddd'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    
    // Hash da senha usando password_hash()
    $senha_hash = password_hash($password, PASSWORD_DEFAULT);

    // Atualizar os dados do usuário na tabela correspondente
    $sql = "UPDATE $tabela SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', password = '$senha_hash', ddd = '$ddd', telefone = '$telefone', cep = '$cep', rua = '$rua', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado' WHERE id = $usuario_id";
    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        echo "Dados atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados.";
    }
}

// Buscar os dados do usuário atual na tabela correspondente
$sql = "SELECT * FROM $tabela WHERE id = $usuario_id";
$result = mysqli_query($mysqli, $sql);
$usuario = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!----======== CSS ======== -->
    <title>Alterar Dados do Usuário</title>
</head>
<body>
    <h1>Alterar Dados do Usuário</h1>
    <form id="updateForm" method="post" action="#">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>"><br><br>
        
        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $usuario['sobrenome']; ?>"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>"><br><br>
        
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" value=""><br><br>
        
        <label for="ddd">DDD:</label>
        <input type="text" name="ddd" id="ddd" value="<?php echo $usuario['ddd']; ?>"><br><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?php echo $usuario['telefone']; ?>"><br><br>
        
        <label for="cep">CEP:</label>
        <input type="text" name="cep" id="cep" value="<?php echo $usuario['cep']; ?>"><br><br>
        
        <label for="rua">Rua:</label>
        <input type="text" name="rua" id="rua" value="<?php echo $usuario['rua']; ?>"><br><br>
        
        <label for="numero">Número:</label>
        <input type="text" name="numero" id="numero" value="<?php echo $usuario['numero']; ?>"><br><br>
        
        <label for="complemento">Complemento:</label>
        <input type="text" name="complemento" id="complemento" value="<?php echo $usuario['complemento']; ?>"><br><br>
        
        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" value="<?php echo $usuario['bairro']; ?>"><br><br>
        
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" value="<?php echo $usuario['cidade']; ?>"><br><br>
        
        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" value="<?php echo $usuario['estado']; ?>"><br><br>
        
        <input type="submit" name="submit" value="Salvar">
    </form>
</body>
</html>
