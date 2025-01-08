<?php
session_start();
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nome'])) {
        $erro = "Preencha seu nome";
    } else if (empty($_POST['pass'])) {
        $erro = "Preencha sua senha";
    } else {
      
    }
}
$nome = isset($_POST['nome']) ? $mysqli->real_escape_string($_POST['nome']) : '';
$pass = isset($_POST['pass']) ? $mysqli->real_escape_string($_POST['pass']) : '';
$sql_code = "SELECT * FROM utilizadores WHERE nome = '$nome' AND pass = '$pass'";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL:
$mysqli->error");
$quantidade = $sql_query->num_rows;
if ($quantidade == 1) {

    
        $utilizadores = $sql_query->fetch_assoc();
        $_SESSION['id'] = $utilizadores['id'];
        $_SESSION['nome'] = $utilizadores['nome'];
        header("Location: ./ponto.php");
        exit();
}
else {
        $erro = "Falha ao logar! Nome ou Pass incorretos";
    }
    

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <?php if (isset($erro)) echo "<p class='error'>$erro</p>"; ?>
        <form method="POST" action="">
            <input type="text" class="login-input" placeholder="Nome" name="nome">
            <br><br>
            <input type="password" class="login-input" placeholder="Senha" name="pass">
            <br><br>
            <button type="submit" class="login-button">Enviar</button>
        </form>
    </div>
</body>

</html>