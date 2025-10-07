<?php

session_start();

include "util.php";

if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    die("Erro: Campos obrigatórios não preenchidos.");
}

$conn = conecta();
$senha = $_POST['senha'];
$senhaCripto = password_hash($senha, PASSWORD_DEFAULT);

// 2. MODIFICAR O SQL
// Adicionamos "RETURNING id_usuario, nome" ao final.
// Este comando do PostgreSQL nos devolve o ID e o nome do usuário que acabamos de criar.
$sql = "INSERT INTO usuario (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha) RETURNING id_usuario, nome";

try {
    $insert = $conn->prepare($sql);
    $insert->bindParam(':nome', $_POST['nome']);
    $insert->bindParam(':email', $_POST['email']);
    $insert->bindParam(':telefone', $_POST['telefone']);
    $insert->bindParam(':senha', $senhaCripto);

    $insert->execute();

    // 3. CAPTURAR OS DADOS DO NOVO USUÁRIO
    // Pegamos os dados (id_usuario e nome) que o comando "RETURNING" nos deu.
    $novoUsuario = $insert->fetch(PDO::FETCH_ASSOC);

    if ($novoUsuario) {
        
        $_SESSION['statusConectado'] = true;
        $_SESSION['admin'] = false; // Um usuário novo nunca é admin
        $_SESSION['login'] = $novoUsuario['nome'];
        $_SESSION['id_usuario'] = $novoUsuario['id_usuario'];

        // 5. REDIRECIONAR PARA A PÁGINA PRINCIPAL
        // Em vez de ir para o login.php, o usuário vai para o index.php, já logado.
        header("Location: ../home.php");
        exit();
    } else {
        // Caso algo inesperado aconteça
        die("Não foi possível registrar o usuário. Tente novamente.");
    }
} catch (PDOException $e) {
    // Tratamento de erro para e-mail duplicado (muito útil!)
    if ($e->getCode() == '23505') {
        die("Erro: O e-mail informado já está cadastrado. <a href='cadastro.php'>Voltar</a>");
    } else {
        die("Erro de banco de dados: " . $e->getMessage());
    }
}
?>