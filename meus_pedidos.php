<?php
session_start();
include 'util.php';

// Segurança: Se o usuário não estiver logado, redireciona para o login.
if (!isset($_SESSION['statusConectado']) || $_SESSION['statusConectado'] !== true) {
    header('Location: login.php?redirect=meus_pedidos.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$mensagem_sucesso = '';

// Verifica se veio da página de finalizar_pedido com sucesso
if (isset($_GET['sucesso']) && $_GET['sucesso'] == '1') {
    $mensagem_sucesso = "Seu pedido foi finalizado com sucesso!";
}

try {
    $conn = conecta();
    
    // Busca todas as COMPRAS (pedidos) do usuário logado, da mais recente para a mais antiga
    $sql_compras = "SELECT * FROM compra WHERE fk_usuario = :id_usuario ORDER BY data DESC";
    $stmt_compras = $conn->prepare($sql_compras);
    $stmt_compras->execute([':id_usuario' => $id_usuario]);
    $compras = $stmt_compras->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $compras = [];
    die("Erro ao buscar pedidos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/meus_pedidos.css"> <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Meus Pedidos</h1>

            <?php if ($mensagem_sucesso): ?>
                <div class="alert-success"><?php echo $mensagem_sucesso; ?></div>
            <?php endif; ?>

            <div class="orders-list">
                <?php if (empty($compras)): ?>
                    <p class="no-orders-message">Você ainda não fez nenhum pedido.</p>
                <?php else: ?>
                    <?php foreach ($compras as $compra): ?>
                        <details class="order-item">
                            <summary class="order-summary">
                                <div class="order-info">
                                    <strong>Pedido #<?php echo $compra['id_compra']; ?></strong>
                                    <span>Data: <?php echo date('d/m/Y', strtotime($compra['data'])); ?></span>
                                </div>
                                <div class="order-status">
                                    <span class="status-badge status-<?php echo strtolower(str_replace(' ', '-', $compra['status'])); ?>">
                                        <?php echo str_replace('_', ' ', $compra['status']); ?>
                                    </span>
                                </div>
                            </summary>

                            <div class="order-details">
                                <?php
                                // Busca os itens para esta compra específica
                                $sql_itens = "SELECT p.nome, p.imagem, cp.quantidade, cp.valor_unitario 
                                              FROM compra_produto cp 
                                              JOIN produto p ON cp.fk_produto = p.id_produto 
                                              WHERE cp.fk_compra = :id_compra";
                                $stmt_itens = $conn->prepare($sql_itens);
                                $stmt_itens->execute([':id_compra' => $compra['id_compra']]);
                                $itens_pedido = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
                                $valor_total_calculado = 0;
                                ?>
                                <?php foreach ($itens_pedido as $item): ?>
                                    <div class="product-item">
                                        <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                                        <div class="product-info">
                                            <p class="product-name"><?php echo htmlspecialchars($item['nome']); ?></p>
                                            <p class="product-quantity">Quantidade: <?php echo $item['quantidade']; ?></p>
                                        </div>
                                        <div class="product-price">
                                            R$ <?php echo number_format($item['valor_unitario'] * $item['quantidade'], 2, ',', '.'); ?>
                                        </div>
                                    </div>
                                    <?php $valor_total_calculado += $item['valor_unitario'] * $item['quantidade']; ?>
                                <?php endforeach; ?>
                                <div class="order-total">
                                    <strong>Total do Pedido: R$ <?php echo number_format($valor_total_calculado, 2, ',', '.'); ?></strong>
                                </div>
                            </div>
                        </details>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php include "footer.php"; ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>