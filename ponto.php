<?php
session_start();
include('conexao.php');

file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents('debug.log', date('Y-m-d H:i:s') . " - POST Data: " . print_r($_POST, true) . "\n", FILE_APPEND);
}

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$nome = $_SESSION['nome'];
$utilizador_id = $_SESSION['id'];
$mensagem = '';
$erro = '';

// Processar o registro de ponto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['marcar_ponto'])) {
    $tipo = $_POST['marcar_ponto'];
    $data_hora = date('Y-m-d H:i:s');

    // Verificar se já existe um registro hoje
    $sql_check = "SELECT * FROM registros_ponto 
                  WHERE utilizador_id = ? 
                  AND DATE(data_hora) = CURDATE() 
                  AND tipo = ?";
    $stmt_check = $mysqli->prepare($sql_check);
    $stmt_check->bind_param("is", $utilizador_id, $tipo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Se não existir registro, insere
        $sql = "INSERT INTO registros_ponto (utilizador_id, data_hora, tipo) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iss", $utilizador_id, $data_hora, $tipo);

        if ($stmt->execute()) {
            $mensagem = "Ponto registrado com sucesso!";
        } else {
            $erro = "Erro ao registrar o ponto: " . $mysqli->error;
        }
    } else {
        $erro = "Já existe um registro de $tipo para hoje.";
    }
}

// Buscar os últimos registros de ponto do utilizador
$sql = "SELECT * FROM registros_ponto WHERE utilizador_id = ? ORDER BY data_hora DESC LIMIT 5";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $utilizador_id);
$stmt->execute();
$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ponto</title>
    <link rel="stylesheet" href="mponto.css">
</head>

<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h1>

        <?php if (!empty($mensagem)) echo "<p class='success'>$mensagem</p>"; ?>
        <?php if (!empty($erro)) echo "<p class='error'>$erro</p>"; ?>

        <form method="POST" action="">
            <button type="submit" name="marcar_ponto" value="saida" class="ponto-button">Marcar Saída</button>
        </form>

        <h2>Últimos Registros</h2>
        
        <table>
            <tr>
                <th>Nome</th>
                <th>Data e Hora</th>
                <th>Tipo</th>
            </tr>
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($nome); ?></td>
                        <td><?php echo htmlspecialchars($row['data_hora']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($row['tipo'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Não há registros de ponto para exibir.</td>
                </tr>
            <?php endif; ?>
        </table>

        <a href="logout.php" class="logout-button">Sair</a>
    </div>
</body>

</html>
