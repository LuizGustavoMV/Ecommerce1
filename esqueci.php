<?php
// Bloco seguro para iniciar a sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "util.php";
include "emails.php"; 

$mensagem = '';
$cor_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    try {
        $conn = conecta();
        $email = $_POST['email'];
        $select = $conn->prepare("SELECT nome, senha FROM usuario WHERE email = :email AND excluido = false");
        $select->bindParam(':email', $email);
        $select->execute();
        $linha = $select->fetch();

        if ($linha) {
            $token = $linha['senha']; 
            $nome = $linha['nome'];
            
            $link_redefinicao = "http://localhost:3000/redefinir.php?token=$token";
            
            $html = "<h4>Redefinir sua senha</h4><br><b>Oi $nome</b>, <br>Clique no link para redefinir sua senha:<br><a href='$link_redefinicao'>$link_redefinicao</a>";
            
            if (function_exists('EnviaEmail') && EnviaEmail($email, 'Recuperação de Senha', $html)) {
                $mensagem = "Email enviado com sucesso! Verifique sua caixa de entrada.";
                $cor_mensagem = 'green';
            } else {
                 $mensagem = "Ocorreu um erro ao enviar o e-mail.";
                 $cor_mensagem = 'red';
             }

        }
    } catch (Exception $e) {
        $mensagem = "Ocorreu um erro no servidor. Tente novamente.";
        $cor_mensagem = 'red';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - PulsoTech</title>
    
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; // Alterado de 'header.php' para 'nav.php' para consistência ?>
    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-key"></i></div>
                <h2>Recuperar Senha</h2>
                <p style="margin-bottom: 20px; color: var(--gray-600);">Digite seu e-mail para receber o link de recuperação.</p>

                <?php if (!empty($mensagem)): ?>
                    <div class="auth-error-message" style="background-color: <?php echo $cor_mensagem; ?>; color: white; border: none; padding: 15px;">
                        <?php echo $mensagem; ?>
                    </div>
                <?php endif; ?>

                <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $cor_mensagem === 'red'): // Só mostra o formulário se ainda não foi enviado ou se deu erro ?>
                    <form class="auth-form" action='esqueci.php' method='post'>
                        <div class="form-group">
                            <label for="email">Seu e-mail:</label>
                            <input type='email' id="email" name='email' placeholder="email@exemplo.com" required>
                        </div>
                        <button type='submit' class="auth-btn">Enviar Link</button>
                    </form>
                <?php endif; ?>

                <p class="auth-switch-link" style="margin-top: 20px;"><a href="login.php">Lembrou a senha? Voltar para o Login</a></p>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>