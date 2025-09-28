<?php
// Pega o nome do arquivo da página atual, ex: "home.php", "sobre.php"
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header class="header">
    <div class="container">
        <div class="logo">
            <a href="home.php"><img src="assets/images/logo-Photoroom.png" alt="PulsoTech"></a>
        </div>
        <nav class="nav">
            <a href="sobre.php" class="nav-btn <?php echo ($currentPage == 'sobre.php') ? 'active' : ''; ?>">
                <i class="fas fa-info-circle"></i> SOBRE
            </a>

            <a href="produtos.php" class="nav-btn <?php echo ($currentPage == 'produtos.php' || $currentPage == 'home.php') ? 'active' : ''; ?>">
                <i class="fas fa-shopping-bag"></i> PRODUTOS
            </a>

            <a href="cti.php" class="nav-btn <?php echo ($currentPage == 'cti.php') ? 'active' : ''; ?>">
                <i class="fas fa-graduation-cap"></i> CTI
            </a>

            <a href="suporte.php" class="nav-btn <?php echo ($currentPage == 'suporte.php') ? 'active' : ''; ?>">
                <i class="fas fa-headset"></i> SUPORTE
            </a>
        </nav>
        <div class="user-actions">
            <button class="user-menu-btn" id="userMenuBtn"><i class="fas fa-user"></i></button>
            <a href="carrinho.php" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-counter" id="cartCounter">0</span>
            </a>
            <div class="user-dropdown" id="userDropdown">
                <button class="dropdown-btn" id="loginBtn" data-modal-target="#loginModal">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
                <button class="dropdown-btn" id="registerBtn" data-modal-target="#registerModal">
                    <i class="fas fa-user-plus"></i> Cadastrar
                </button>
            </div>
        </div>
    </div>
</header>