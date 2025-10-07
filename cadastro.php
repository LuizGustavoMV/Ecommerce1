<?php
// --- PARTE 1: LÓGICA PHP ---
session_start();

include "util.php"; 

$dados_antigos = [];
$erros = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados_antigos = $_POST;

    // 1. Validação dos campos no servidor
    if (empty($_POST['nome'])) $erros['nome'] = "Por favor, preencha seu nome.";
    if (empty($_POST['email'])) $erros['email'] = "O e-mail é obrigatório.";
    if (empty($_POST['senha'])) $erros['senha'] = "Você precisa definir uma senha.";
    if ($_POST['senha'] !== $_POST['confirmar_senha']) {
        $erros['confirmar_senha'] = "As senhas não coincidem.";
    }

    // 2. Se não houver erros, processa o cadastro
    if (count($erros) == 0) {
        try {
            $conn = conecta();
            $senhaCriptografada = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (nome, email, telefone, senha) 
                    VALUES (:nome, :email, :telefone, :senha) 
                    RETURNING id_usuario, nome, admin";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':email', $_POST['email']);
            $telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':senha', $senhaCriptografada);
            $stmt->execute();

            $novoUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($novoUsuario) {
                session_regenerate_id(true);
                $_SESSION['statusConectado'] = true;
                $_SESSION['id_usuario'] = $novoUsuario['id_usuario'];
                $_SESSION['nome_usuario'] = $novoUsuario['nome'];
                $_SESSION['admin'] = (bool) $novoUsuario['admin'];
                
                header("Location: ../home.php");
                exit();
            }
        } catch (PDOException $e) {
            if ($e->getCode() == '23505') {
                $erros['email'] = "Este e-mail já está em uso.";
            } else {
                $erros['geral'] = "Ocorreu uma falha no sistema. Tente novamente.";
                error_log($e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - PulsoTech</title>
    
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .error-message { 
            color: #d9534f; /* Um tom de vermelho */
            font-size: 0.85em;
            margin-top: 4px;
            display: block; /* Para que o erro apareça abaixo do input */
        }
    </style>
</head>
<body>


    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-user-plus"></i></div>
                <h2>Criar Conta</h2>

                <form class="auth-form" method="POST" action="cadastro.php">
                    
                    <?php if (isset($erros['geral'])): ?>
                        <div class="form-group">
                           <span class="error-message"><?php echo htmlspecialchars($erros['geral']); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados_antigos['nome'] ?? ''); ?>" required>
                        <?php if (isset($erros['nome'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($erros['nome']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($dados_antigos['email'] ?? ''); ?>" required>
                         <?php if (isset($erros['email'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($erros['email']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone (Opcional):</label>
                        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($dados_antigos['telefone'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                         <?php if (isset($erros['senha'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($erros['senha']); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha:</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                        <?php if (isset($erros['confirmar_senha'])): ?>
                            <span class="error-message"><?php echo htmlspecialchars($erros['confirmar_senha']); ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="auth-btn">Cadastrar</button>
                </form>
                <p class="auth-switch-link">Já tem uma conta? <a href="login.php">Faça login</a></p>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html>