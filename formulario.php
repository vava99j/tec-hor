<?php
$host = 'caboose.proxy.rlwy.net';
$db = 'railway'; // Nome real do banco
$user = 'root';
$pass = 'cmycwbxOMFMpcibfJvVWEuGkLfZMvtbQ';
$port = 13240;

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo "erro na conexão: " . $conn->connect_error;
    exit;
}

$nome = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['phone'] ?? '';
$mensagem = $_POST['textarea'] ?? '';

$stmt = $conn->prepare("INSERT INTO DBMensagem (nome, email, telefone, mensagem) VALUES (?, ?, ?, ?);");
$stmt->bind_param("ssss", $nome, $email, $telefone, $mensagem);

if ($stmt->execute()) {
    echo "sucesso";
} else {
    http_response_code(500);
    echo "erro ao inserir: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
