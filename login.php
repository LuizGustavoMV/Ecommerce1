<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PulsoTech</title>
    
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css"> {/* Nosso novo CSS */}
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                <h2>Iniciar Sessão</h2>
                <form class="auth-form">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" required>
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" required>
                    </div>
                    <button type="submit" class="auth-btn">Entrar</button>
                </form>
                <p class="auth-switch-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html>