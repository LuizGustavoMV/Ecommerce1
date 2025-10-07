<?php
session_start();
// Segurança: Apenas admins podem ver esta página.
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
    header("Location: ../home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário - Admin</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="stylesheet" href="assets/css/components/modal.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../nav.php'; ?>

    <main class="main-content">
        <div class="admin-container">
            <h1>Adicionar Novo Usuário</h1>
            <a href="usuario/usuarios.php" class="add-btn" style="background: var(--gray-600); margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Voltar para a Lista</a>

            <div class="auth-box" style="max-width: none; margin: 0; text-align: left;">
                <form class="auth-form" method="POST" action="usuario/insertUsuarios.php">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" placeholder="email@exemplo.com" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Senha forte" required>
                    </div>

                    <button type="submit" class="auth-btn">Adicionar Usuário</button>
                </form>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; ?>
</body>
</html>