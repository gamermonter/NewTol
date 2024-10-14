<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_accounts";

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificação se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $account_name = isset($_POST['account_name']) ? trim($_POST['account_name']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $game_type = isset($_POST['game_type']) ? trim($_POST['game_type']) : null;

    // Verificar se os campos estão vazios
    if (empty($account_name) || empty($password) || empty($game_type)) {
        

        
    }

    // Hash da senha
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Inserir os dados na tabela
    $sql = "INSERT INTO accounts (account_name, password_hash, game_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        header("Location: index.html?status=error&message=Erro ao preparar a consulta");

        exit();
    }
    $stmt->bind_param("sss", $account_name, $password_hash, $game_type);

    if ($stmt->execute()) {
        header("Location: index.html?status=success&message=Conta criada com sucesso");
    } else {
        // Log do erro e mensagem genérica para o usuário
        error_log("Erro ao adicionar conta: " . $stmt->error);
        header("Location: index.html?status=error&message=Erro ao adicionar conta. Tente novamente mais tarde.");
    }

    // Fechar o statement
    $stmt->close();
}

// Fechar a conexão
$conn->close();
?>
