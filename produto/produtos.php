<?php
session_start();
include 'util.php';

// Lógica para buscar os produtos no banco.
try {
    $conn = conecta();
    $sql = "SELECT * FROM produto ORDER BY id_produto ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro = "Ocorreu um erro ao buscar os produtos.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos - Admin</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>

    <main class="main-content">
        <div class="admin-container">
            <h1>Gerenciamento de Produtos</h1>

            <a href="produto/adicionarProduto.php" class="add-btn"><i class="fas fa-plus"></i> Adicionar Novo Produto</a>

            <?php if (isset($erro)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
            <?php elseif (empty($produtos)): ?>
                <p>Nenhum produto encontrado.</p>
            <?php else: ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Descrição</th> <th>Valor</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td data-label="ID"><?php echo htmlspecialchars($produto['id_produto']); ?></td>
                                <td data-label="Imagem">
                                    <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" width="80" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="border-radius: var(--radius-sm);">
                                </td>
                                <td data-label="Nome"><?php echo htmlspecialchars($produto['nome']); ?></td>
                                
                                <td data-label="Descrição"><?php echo htmlspecialchars($produto['descricao']); ?></td>
                                
                                <td data-label="Valor">R$ <?php echo number_format($produto['valor_unitario'], 2, ',', '.'); ?></td>
                                <td data-label="Status">
                                    <?php if ($produto['excluido']): ?>
                                        <span class="status-inactive">Excluído</span>
                                    <?php else: ?>
                                        <span class="status-active">Ativo</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Ações">
                                    <a href="produto/alterarProduto.php?id=<?php echo $produto['id_produto']; ?>" class="action-btn edit-btn" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php if (!$produto['excluido']): ?>
                                        <a href="produto/deleteProduto.php?id=<?php echo $produto['id_produto']; ?>" class="action-btn delete-btn" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>