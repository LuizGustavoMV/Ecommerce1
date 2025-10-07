<?php
include "util.php";
session_start();

// Garante que apenas administradores possam executar este script
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
    header("Location: ../index.php");
    exit();
}

// Verifica se os dados essenciais foram enviados
if (!isset($_POST['id_usuario'], $_POST['nome'], $_POST['email'], $_POST['admin'])) {
    die("Erro: Dados do formulário incompletos.");
}

// Coleta dos dados do formulário
$id_usuario = $_POST['id_usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'] ?? ''; // Usa '' se o telefone vier nulo
$admin_value_from_post = $_POST['admin'];

// Lógica de conversão final
$admin_final_boolean = ($admin_value_from_post == '1');

$conn = conecta();

// Lógica para atualização opcional da senha
if (!empty($_POST['senha'])) {
    $sql = "UPDATE usuario 
            SET nome = :nome, email = :email, telefone = :telefone, senha = :senha, admin = :admin 
            WHERE id_usuario = :id_usuario";
} else {
    $sql = "UPDATE usuario 
            SET nome = :nome, email = :email, telefone = :telefone, admin = :admin 
            WHERE id_usuario = :id_usuario";
}

// Prepara a query
$stmt = $conn->prepare($sql);

// Vincula os parâmetros usando o método explícito e seguro (bindValue)
$stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->bindValue(':nome', $nome);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':telefone', ''.$telefone);
$stmt->bindValue(':admin', $admin_final_boolean, PDO::PARAM_BOOL);

// Se a senha foi preenchida, vincula o parâmetro da senha também
if (!empty($_POST['senha'])) {
    $senhaCripto = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $stmt->bindValue(':senha', $senhaCripto);
}

// Executa a query
$stmt->execute();

// Redireciona de volta para a lista de usuários
header("Location: usuarios.php");
exit();
?>