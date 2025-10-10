<?php
session_start();
include 'util.php';

// --- VERIFICAÇÃO INICIAL ---
$isLoggedIn = isset($_SESSION['statusConectado']) && $_SESSION['statusConectado'] === true;
$id_usuario = $isLoggedIn ? $_SESSION['id_usuario'] : null;
$conn = conecta();

// --- LÓGICA DE MANIPULAÇÃO DO CARRINHO ---
$operacao = $_GET['operacao'] ?? '';
$id_produto = filter_input(INPUT_GET, 'id_produto', FILTER_VALIDATE_INT);
// Pega a quantidade da URL. Se não vier, o padrão é 1.
$quantidade_a_adicionar = filter_input(INPUT_GET, 'qtd', FILTER_VALIDATE_INT);
if ($quantidade_a_adicionar <= 0) {
    $quantidade_a_adicionar = 1;
}


if ($id_produto && $operacao) {
    if ($isLoggedIn) {
        // ========== LÓGICA PARA USUÁRIO LOGADO (BANCO DE DADOS) ==========
        $stmt = $conn->prepare("SELECT id_compra FROM compra WHERE fk_usuario = :id_usuario AND status = 'carrinho'");
        $stmt->execute([':id_usuario' => $id_usuario]);
        $compra_ativa = $stmt->fetch();
        $id_compra = $compra_ativa ? $compra_ativa['id_compra'] : null;

        if (!$id_compra && $operacao === 'incluir') {
            $stmt = $conn->prepare("INSERT INTO compra (fk_usuario, status, sessao) VALUES (:id_usuario, 'carrinho', :sessao)");
            $stmt->execute([':id_usuario' => $id_usuario, ':sessao' => session_id()]);
            $id_compra = $conn->lastInsertId();
        }

        if ($id_compra) {
            $stmt = $conn->prepare("SELECT quantidade FROM compra_produto WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
            $stmt->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto]);
            $item_existente = $stmt->fetch();

            if ($operacao === 'incluir') {
                if ($item_existente) {
                    $stmt = $conn->prepare("UPDATE compra_produto SET quantidade = quantidade + :qtd WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                    $stmt->execute([':qtd' => $quantidade_a_adicionar, ':id_compra' => $id_compra, ':id_produto' => $id_produto]);
                } else {
                    $stmt_prod = $conn->prepare("SELECT valor_unitario FROM produto WHERE id_produto = :id");
                    $stmt_prod->execute([':id' => $id_produto]);
                    $produto = $stmt_prod->fetch();
                    
                    $stmt = $conn->prepare("INSERT INTO compra_produto (fk_compra, fk_produto, quantidade, valor_unitario) VALUES (:id_compra, :id_produto, :qtd, :valor)");
                    $stmt->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto, ':qtd' => $quantidade_a_adicionar, ':valor' => $produto['valor_unitario']]);
                }
            } elseif ($operacao === 'decrementar' && $item_existente) {
                if ($item_existente['quantidade'] > 1) {
                    $stmt = $conn->prepare("UPDATE compra_produto SET quantidade = quantidade - 1 WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                    $stmt->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto]);
                } else {
                    $stmt = $conn->prepare("DELETE FROM compra_produto WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                    $stmt->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto]);
                }
            } elseif ($operacao === 'remover' && $item_existente) {
                $stmt = $conn->prepare("DELETE FROM compra_produto WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                $stmt->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto]);
            }

            // Após remover/decrementar, verifica se o carrinho ficou vazio para cancelar a compra
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM compra_produto WHERE fk_compra = :id_compra");
            $stmt->execute([':id_compra' => $id_compra]);
            if ($stmt->fetch()['total'] == 0) {
                $stmt_cancel = $conn->prepare("UPDATE compra SET status = 'cancelado' WHERE id_compra = :id_compra");
                $stmt_cancel->execute([':id_compra' => $id_compra]);
            }
        }
    } else {
        // ========== LÓGICA PARA VISITANTE (SESSÃO) ==========
        if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];

        if ($operacao === 'incluir') {
            if (isset($_SESSION['carrinho'][$id_produto])) {
                $_SESSION['carrinho'][$id_produto]['quantidade'] += $quantidade_a_adicionar;
            } else {
                $stmt = $conn->prepare("SELECT nome, valor_unitario, imagem FROM produto WHERE id_produto = :id");
                $stmt->execute([':id' => $id_produto]);
                $produto = $stmt->fetch();
                if ($produto) {
                    $_SESSION['carrinho'][$id_produto] = ['nome' => $produto['nome'], 'preco' => $produto['valor_unitario'], 'imagem' => $produto['imagem'], 'quantidade' => $quantidade_a_adicionar];
                }
            }
        } elseif ($operacao === 'decrementar' && isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto]['quantidade']--;
            if ($_SESSION['carrinho'][$id_produto]['quantidade'] <= 0) unset($_SESSION['carrinho'][$id_produto]);
        } elseif ($operacao === 'remover' && isset($_SESSION['carrinho'][$id_produto])) {
            unset($_SESSION['carrinho'][$id_produto]);
        }
    }
    header('Location: carrinho.php');
    exit();
}

// --- LÓGICA PARA EXIBIR O CARRINHO ---
$carrinho_itens = [];
$total_carrinho = 0;

if ($isLoggedIn) {
    // Busca o carrinho do usuário logado no banco de dados
    $stmt = $conn->prepare("SELECT c.id_compra, cp.fk_produto as id, p.nome, p.imagem, cp.quantidade, cp.valor_unitario as preco
                            FROM compra c
                            JOIN compra_produto cp ON c.id_compra = cp.fk_compra
                            JOIN produto p ON cp.fk_produto = p.id_produto
                            WHERE c.fk_usuario = :id_usuario AND c.status = 'carrinho'");
    $stmt->execute([':id_usuario' => $id_usuario]);
    $itens_db = $stmt->fetchAll();
    
    foreach($itens_db as $item){
        $carrinho_itens[$item['id']] = $item;
    }
} else {
    // Pega o carrinho da sessão para o visitante
    $carrinho_itens = $_SESSION['carrinho'] ?? [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/carrinho.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <div class="container">
            <div class="cart-title-header">
                <h1>Meu Carrinho</h1>
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="cart-container-new">
                <div class="cart-product-list">
                    <div class="list-header">
                        <span>PRODUTO</span>
                        <span style="text-align: center;">QTD</span>
                        <span style="text-align: right;">SUBTOTAL</span>
                    </div>
                    <?php if (empty($carrinho_itens)): ?>
                        <p class="cart-empty-message">Seu carrinho está vazio.</p>
                    <?php else: ?>
                        <?php foreach ($carrinho_itens as $id => $item): ?>
                            <?php 
                                $subtotal = $item['preco'] * $item['quantidade'];
                                $total_carrinho += $subtotal;
                            ?>
                            <div class="cart-item">
                                <div class="cart-item-info">
                                    <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                                    <div>
                                        <p class="cart-item-name"><?php echo htmlspecialchars($item['nome']); ?></p>
                                        <p class="cart-item-price">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                                    </div>
                                </div>
                                <div class="cart-item-quantity">
                                    <a href="carrinho.php?operacao=decrementar&id_produto=<?php echo $id; ?>" class="quantity-btn">-</a>
                                    <span><?php echo $item['quantidade']; ?></span>
                                    <a href="carrinho.php?operacao=incluir&id_produto=<?php echo $id; ?>" class="quantity-btn">+</a>
                                </div>
                                <div class="cart-item-total">
                                    R$ <?php echo number_format($subtotal, 2, ',', '.'); ?>
                                </div>
                                <a href="carrinho.php?operacao=remover&id_produto=<?php echo $id; ?>" class="remove-item-btn" title="Remover Item">&times;</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="cart-summary-new">
                    <div class="list-header">RESUMO DO PEDIDO</div>
                    <div class="summary-total-new">
                        <span>TOTAL</span>
                        <span id="cartTotal">R$ <?php echo number_format($total_carrinho, 2, ',', '.'); ?></span>
                    </div>
                    <?php if (!empty($carrinho_itens)): ?>
                        <?php if ($isLoggedIn): ?>
                            <a href="finalizar_pedido.php" class="auth-btn" style="width: 100%; margin-top: 20px; text-align:center;">Finalizar Compra</a>
                        <?php else: ?>
                            <p style="text-align: center; color: var(--gray-600); margin-top: 15px;">Você precisa fazer login para continuar.</p>
                            <a href="login.php?redirect=carrinho.php" class="auth-btn" style="width: 100%; margin-top: 10px; text-align:center;">Fazer Login</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    
    <?php include "footer.php"; ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>