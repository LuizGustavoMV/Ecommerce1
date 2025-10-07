<?php
session_start();
include "../util.php";

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
    header("Location: ../home.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de produto inválido.");
}

$conn = conecta();
$sql = "SELECT * FROM produto WHERE id_produto = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Admin</title>

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
            <h1>Editar Produto: <?php echo htmlspecialchars($produto['nome']); ?></h1>
            <a href="produto/produtos.php" class="add-btn" style="background: var(--gray-600); margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Voltar para a Lista</a>

            <div class="auth-box" style="max-width: none; margin: 0; text-align: left;">
                <form class="auth-form" method="POST" action="admin/update_produto.php" enctype="multipart/form-data">
                    <input type='hidden' name='id_produto' value='<?php echo $produto['id_produto']; ?>'>
                    <input type='hidden' name='imagem_atual' value='<?php echo htmlspecialchars($produto['imagem']); ?>'>
                    
                    <div class="form-group">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" id="nome" name="nome" value='<?php echo htmlspecialchars($produto['nome']); ?>' required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4" class="form-group input" style="padding: var(--spacing-md); width:100%; border: 2px solid var(--gray-200); border-radius: var(--radius-lg); font-size: 16px; background: var(--gray-50);"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="valor_unitario">Valor (R$):</label>
                        <input type="text" id="valor_unitario" name="valor_unitario" placeholder="Ex: 99,90" value='<?php echo number_format($produto['valor_unitario'], 2, ',', '.'); ?>' required>
                    </div>

                    <div class="form-group">
                        <label>Imagem Atual:</label>
                        <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" width="150" style="border-radius: var(--radius-md); border: 2px solid var(--gray-200); padding: 5px;">
                    </div>
                    
                    <div class="form-group">
                        <label for="imagem">Enviar nova imagem (opcional):</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*" class="form-group input">
                    </div>

                    <button type="submit" class="auth-btn">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; ?>
</body>
</html>