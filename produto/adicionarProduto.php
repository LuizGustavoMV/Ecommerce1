<?php
session_start();


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto - Admin</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../nav.php'; ?>

    <main class="main-content">
        <div class="admin-container">
            <h1>Adicionar Novo Produto</h1>
            <a href="produto/produtos.php" class="add-btn" style="background: var(--gray-600); margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Voltar para a Lista</a>

            <div class="auth-box" style="max-width: none; margin: 0; text-align: left;">
                <form class="auth-form" method="POST" action="produto/insertProdutos.php">
                    <div class="form-group">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4" class="form-group input" style="padding: var(--spacing-md); width:100%; border: 2px solid var(--gray-200); border-radius: var(--radius-lg); font-size: 16px; background: var(--gray-50);"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="valor_unitario">Valor (R$):</label>
                        <input type="text" id="valor_unitario" name="valor_unitario" placeholder="Ex: 99,90" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="imagem_nome">Nome do Arquivo da Imagem:</label>
                        <input type="text" id="imagem_nome" name="imagem_nome" class="form-group input" placeholder="ex: pulseira_mec.png" required>
                        <small style="color: var(--gray-500); margin-top: 5px; display: block;">A imagem já deve estar na pasta `assets/images/`.</small>
                    </div>

                    <button type="submit" class="auth-btn">Adicionar Produto</button>
                </form>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; ?>
</body>
</html>