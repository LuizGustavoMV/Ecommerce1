<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="home.php"><img src="assets/images/logo-Photoroom.png" alt="PulsoTech"></a>
            </div>
            <?php include "nav.php"; ?>
            <div class="user-actions">
                <button class="user-menu-btn" id="userMenuBtn"><i class="fas fa-user"></i></button>
                <a href="carrinho.php" class="cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-counter" id="cartCounter">0</span>
                </a>
                <div class="user-dropdown" id="userDropdown">
                    <button class="dropdown-btn" id="loginBtn"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                    <button class="dropdown-btn" id="registerBtn"><i class="fas fa-user-plus"></i> Cadastrar</button>
                </div>
            </div>
        </div>
    </header>

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