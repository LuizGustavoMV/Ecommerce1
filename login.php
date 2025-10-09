<?php

session_start();

// Variável para guardar a mensagem de erro, se houver.
$erro = null;

// Verifica se o formulário foi enviado (se a requisição é do tipo POST).
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    include "util.php"; // Inclui seu arquivo de conexão com o banco.

    // Validação básica
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Por favor, preencha o e-mail e a senha.";
    } else {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        try {
            $conn = conecta();

            // A query busca um usuário ativo pelo e-mail fornecido.
            $sql = "SELECT id_usuario, nome, senha, admin 
                    FROM usuario 
                    WHERE email = :email AND excluido = false";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verifica se um usuário foi encontrado E se a senha bate com o hash no banco.
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Sucesso! Regenera a sessão e guarda as informações do usuário.
                session_regenerate_id(true);
                $_SESSION['statusConectado'] = true;
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome_usuario'] = $usuario['nome']; // Renomeado para consistência
                $_SESSION['admin'] = (bool)$usuario['admin'];
                
                // Redireciona para a página principal.
                header("Location: home.php");
                exit();
            } else {
                // Se não encontrou usuário ou a senha está errada, define a mensagem de erro.
                $erro = "E-mail ou senha inválidos.";
            }
        } catch (PDOException $e) {
            $erro = "Ocorreu um erro no servidor. Tente novamente mais tarde.";
            error_log($e->getMessage()); // É uma boa prática registrar o erro real.
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PulsoTech</title>
    
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .auth-error-message {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>


    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                <h2>Iniciar Sessão</h2>

                <?php // Se a variável $erro foi definida, exibe a mensagem aqui.
                if (isset($erro)): ?>
                    <div class="auth-error-message">
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>

                <form class="auth-form" method="POST" action="login.php">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="auth-btn">Entrar</button>
                </form>
                <p class="auth-switch-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                 <a href="esqueci.php">Esqueci minha senha</a></p>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html>