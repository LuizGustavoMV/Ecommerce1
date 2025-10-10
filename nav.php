<?php
// Bloco seguro para iniciar a sessão, caso ainda não tenha sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
            <a href="home.php" class="nav-btn <?php echo ($currentPage == 'produtos.php' || $currentPage == 'home.php') ? 'active' : ''; ?>">
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
                <span class="cart-counter" id="cartCounter">
                    <?php
                    // Conta os itens no carrinho da sessão e exibe a contagem
                    $total_itens_carrinho = 0;
                    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
                        foreach ($_SESSION['carrinho'] as $item) {
                            $total_itens_carrinho += $item['quantidade'];
                        }
                    }
                    echo $total_itens_carrinho;
                    ?>
                </span>
            </a>

            <div class="user-dropdown" id="userDropdown">
                <?php if (isset($_SESSION['statusConectado']) && $_SESSION['statusConectado'] === true): ?>
                    
                    <?php // --- MENU DO USUÁRIO LOGADO --- ?>
                    <div class="dropdown-header">
                        Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['nome_usuario'])[0]); ?>!
                    </div>

                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                        
                        <?php // --- MENU DO ADMIN --- ?>
                        <a href="usuario/usuarios.php" class="dropdown-btn">
                            <i class="fas fa-tachometer-alt"></i> Usuários
                        </a>
                        <a href="produto/produtos.php" class="dropdown-btn">
                            <i class="fas fa-tachometer-alt"></i> Produtos
                        </a>
                        <a href="meus_pedidos.php" class="dropdown-btn">
                            <i class="fas fa-receipt"></i> Meus Pedidos
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout.php" class="dropdown-btn">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>

                    <?php else: ?>
                        
                        <?php // --- MENU DO USUÁRIO COMUM --- ?>
                        <a href="/usuario/minha_conta.php" class="dropdown-btn">
                            <i class="fas fa-user-circle"></i> Minha Conta
                        </a>
                        <a href="meus_pedidos.php" class="dropdown-btn">
                            <i class="fas fa-receipt"></i> Meus Pedidos
                        </a>
                        <div class="dropdown-divider"></div>
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