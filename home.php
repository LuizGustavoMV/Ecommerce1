<?php
session_start();
include 'util.php';

// Pega o nome do arquivo da página atual para destacar o link ativo no menu
$currentPage = basename($_SERVER['PHP_SELF']);

try {
    $conn = conecta();
    
    // Busca no banco de dados todos os produtos que NÃO estão marcados como excluídos
    $sql_produtos = "SELECT * FROM produto WHERE excluido = FALSE ORDER BY nome ASC";
    
    // ✨ CORREÇÃO AQUI: Trocado 'a' pela variável de conexão '$conn' ✨
    $stmt_produtos = $conn->prepare($sql_produtos);

    $stmt_produtos->execute();
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Se der erro, a lista de produtos ficará vazia para não quebrar a página.
    $produtos = [];
    error_log("Erro ao buscar produtos na home: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PulsoTech - Inovação e Tecnologia</title> 

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/components/card.css">
    <link rel="stylesheet" href="assets/css/components/modal.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <section class="products-section">
            <div class="container">
                
                <?php if (empty($produtos)): ?>
                    <div style="text-align: center; padding: 50px;">
                        <h2>Nenhum produto disponível no momento.</h2>
                        <p>Volte em breve para conferir as novidades!</p>
                    </div>
                <?php else: ?>
                    <div class="products-grid">
                        
                        <?php foreach($produtos as $produto): ?>
                            
                            <div class="product-card <?php echo strtolower(htmlspecialchars($produto['nome'])); ?>" data-modal-target="#modal-<?php echo $produto['id_produto']; ?>">
                                <div class="product-image"><img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>"></div>
                                <font color="White"><b><?php echo strtoupper(htmlspecialchars($produto['nome'])); ?></b><br></font>
                                <div class="product-price">R$ <?php echo number_format($produto['valor_unitario'], 2, ',', '.'); ?></div>
                            </div>

                        <?php endforeach; ?>
                        </div>
                <?php endif; ?>

            </div>
        </section>
    </main>

    <?php foreach($produtos as $produto): ?>
        
        <div class="modal" id="modal-<?php echo $produto['id_produto']; ?>">
            <div class="product-modal-new-content">
                <button class="close-btn-new" data-close-modal>&times;</button>
                <div class="product-modal-new-body">
                    <div class="product-modal-image-wrapper">
                        <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    </div>
                    <div class="product-modal-details-wrapper">
                        <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                        
                        <h2><?php echo htmlspecialchars($produto['titulo_modal'] ?? $produto['nome']); ?></h2>
                        <p><?php echo htmlspecialchars($produto['descricao']); ?></p>

                        <div class="price-container">
                            <span class="product-price-new">R$ <?php echo number_format($produto['valor_unitario'], 2, ',', '.'); ?></span>
                            </div>
                        <div class="quantity-selector-modal">
                            <button class="quantity-btn decrease">-</button>
                            <span class="quantity-value">1</span>
                            <button class="quantity-btn increase">+</button>
                        </div>
                        <div class="action-buttons">
                            
                            <a href="carrinho.php?operacao=incluir&id_produto=<?php echo $produto['id_produto']; ?>" class="btn-add-cart add-to-cart-btn">
                                ADICIONAR AO CARRINHO
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html>