<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "util.php";

$token = $_GET['token'] ?? null;
$mensagem = '';
$cor_mensagem = '';
$mostrar_formulario = false;

// Verificação inicial do token
if (!$token) {
    $mensagem = "Link de redefinição inválido ou não fornecido.";
    $cor_mensagem = 'red';
} else {
    // Lógica para processar o formulário quando enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $token_recebido = $_POST['token'];
        $senha1 = $_POST['senha1'];
        $senha2 = $_POST['senha2'];

        if ($senha1 !== $senha2) {
            $mensagem = "As senhas digitadas não conferem.";
            $cor_mensagem = 'red';
            $mostrar_formulario = true; // Continua mostrando o formulário
        } elseif (strlen($senha1) < 6) {
            $mensagem = "A senha deve ter no mínimo 6 caracteres.";
            $cor_mensagem = 'red';
            $mostrar_formulario = true; // Continua mostrando o formulário
        } else {
            try {
                $conn = conecta();
                // CRIPTOGRAFIA CORRETA (sha256) para ser compatível com o login
                $senha = $_POST['senha'];
                $senhaCripto = password_hash($senha1, PASSWORD_DEFAULT);

                // Atualiza a senha do usuário que possui o token (senha antiga)
                $sql_update = "UPDATE usuario SET senha = :nova_senha WHERE senha = :token_antigo";
                $update = $conn->prepare($sql_update);
                $update->execute([':nova_senha' => $senhaCripto, ':token_antigo' => $token_recebido]);

                if ($update->rowCount() > 0) {
                    $mensagem = "Senha alterada com sucesso!";
                    $cor_mensagem = 'green';
                    $mostrar_formulario = false; // Esconde o formulário após sucesso
                } else {
                    $mensagem = "Token inválido ou expirado. Não foi possível alterar a senha.";
                    $cor_mensagem = 'red';
                    $mostrar_formulario = false;
                }
            } catch (PDOException $e) {
                $mensagem = "Ocorreu um erro no banco de dados.";
                $cor_mensagem = 'red';
            }
        }
    } else {
        // Se não for POST, apenas exibe o formulário
        $mostrar_formulario = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>
    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-lock"></i></div>
                <h2>Crie uma Nova Senha</h2>

                <?php if (!empty($mensagem)): ?>
                    <div class="auth-error-message" style="background-color: <?php echo $cor_mensagem; ?>; color: white; border: none; padding: 15px;">
                        <?php echo htmlspecialchars($mensagem); ?>
                    </div>
                <?php endif; ?>

                <?php if ($mostrar_formulario): ?>
                    <form class="auth-form" action="redefinir.php?token=<?php echo htmlspecialchars($token); ?>" method='post'>
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                        <div class="form-group">
                            <label for="senha1">Nova Senha:</label>
                            <input type='password' name='senha1' id='senha1' required>
                        </div>
                        <div class="form-group">
                            <label for="senha2">Redigite a Nova Senha:</label>
                            <input type='password' name='senha2' id='senha2' required>
                        </div>
                        <button type='submit' class="auth-btn">Alterar Senha</button>
                    </form>
                <?php endif; ?>
                
                <p class="auth-switch-link" style="margin-top: 20px;"><a href="login.php">Ir para a página de Login</a></p>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>