<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - PulsoTech</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/components/modal.css">

    <link rel="stylesheet" href="assets/css/pages/carrinho.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <body>
    <?php include "nav.php"; ?>

    <main class="main-content">
    ...

    <main class="main-content">
        <div class="container">

            <div class="cart-title-header">
                <h1>Meu Carrinho</h1>
                <i class="fas fa-shopping-cart"></i>
            </div>

            <div class="cart-container-new">
                <div class="cart-product-list">
                    <div class="list-header">PRODUTO</div>
                    <div id="cartItemsContainer">
                        <p class="cart-empty-message">Seu carrinho está vazio.</p>
                    </div>
                </div>

                <div class="cart-summary-new">
                    <div class="list-header">TOTAL <i class="fas fa-receipt"></i></div>
                    <div id="summaryItemsContainer">
                        </div>
                    <div class="summary-total-new">
                        <span>TOTAL:</span>
                        <span id="cartTotal">R$ 0,00</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/scripts/script.js"></script>

   <? include "footer.php"; ?> 