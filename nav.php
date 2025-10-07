<?php


// Pega o nome do arquivo da página atual para destacar o link ativo no menu
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
                <?php if (isset($_SESSION['statusConectado']) && $_SESSION['statusConectado'] === true): ?>
                    
                    <?php // --- MENU DO USUÁRIO LOGADO --- ?>
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                        
                        <a href="../usuario/usuarios.php" class="dropdown-btn">
                            <i class="fas fa-users"></i> Usuários
                        </a>
                         <a href="insertAdmin.php" class="dropdown-btn">
                            <i class="fas fa-box-open"></i> Criar Admin
                        </a>
                        <a href="admin_produtos.php" class="dropdown-btn">
                            <i class="fas fa-box-open"></i> Produtos
                        </a>
                        <a href="logout.php" class="dropdown-btn">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>

                    <?php else: ?>
                        
                        <a href="logout.php" class="dropdown-btn">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>

                    <?php endif; ?>

                <?php else: ?>
                    
                    <?php // --- MENU DO VISITANTE (NÃO LOGADO) --- ?>
                    <a href="login.php" class="dropdown-btn">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </a>
                    <a href="cadastro.php" class="dropdown-btn">
                        <i class="fas fa-user-plus"></i> Cadastrar
                    </a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</header>