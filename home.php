<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PulsoTech - Inovação e Tecnologia</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <section class="products-section">
            <div class="container">
                <div class="products-grid">
                    <div class="product-card eletro" data-modal-target="#eletroModal">
                        <div class="product-image"><img src="assets/images/PulseiraEletro.png" alt="Pulseira Eletro"></div>
                        <font color="White"><b>ELETRO</b><br></font>
                        <div class="product-price">R$9,99</div>
                    </div>
                    <div class="product-card mec featured" data-modal-target="#mecModal">
                        <div class="product-image"><img src="assets/images/PulseiraMec.png" alt="Pulseira Mecânica"></div>
                         <font color="White"><b>MEC</b><br></font>
                        <div class="product-price">R$9,99</div>
                    </div>
                    <div class="product-card info" data-modal-target="#infoModal">
                        <div class="product-image"><img src="assets/images/PulseiraInfo.png" alt="Pulseira INFO"></div>
                        <font color="White"><b>INFO</b><br></font>
                        <div class="product-price">R$9,99</div>
                    </div>
                    <div class="product-card cti-card" data-modal-target="#ctiModal">
                        <div class="product-image"><img src="assets/images/PulseiraCTI.png" alt="Pulseira CTI"></div>
                        <font color="White"><b>CTI</b><br></font>
                        <div class="product-price">R$9,99</div>
                    </div>
                    <div class="product-card cti-premium" data-modal-target="#comboModal">
                        <div class="product-image"><img src="assets/images/PulseiraCTI.png" alt="Combo Pulseiras"></div>
                        <font color="White"> <b>COMBO</b><br></font>
                        <div class="product-price">R$16,99</div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal" id="loginModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo img">
                    <img src="assets/images/logo-Photoroom.png" alt="Logo">
                </div>
                <button class="close-btn" data-close-modal>&times;</button>
            </div>
            <div class="user-icon">
                <i class="fas fa-user-circle"></i>
            </div><form class="auth-form">
                <div class="form-group">
                    <label>e-mail:</label>
                    <input type="email" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" required>
                </div>
                <button type="submit" class="auth-btn">INICIAR SESSÃO</button>
            </form>
        </div>
    </div>
    <div class="modal" id="registerModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo img">
                    <img src="assets/images/logo-Photoroom.png" alt="Logo">
                </div>
                <button class="close-btn" data-close-modal>&times;</button>
            </div>
            <div class="user-icon"><i class="fas fa-user-circle"></i></div>
            <form class="auth-form">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>e-mail:</label>
                    <input type="email" required>
                </div><div class="form-group">
                    <label>Senha:</label>
                    <input type="password" required>
                </div>
                <button type="submit" class="auth-btn">CADASTRAR-SE</button>
            </form>
        </div>
    </div>

    <div class="modal" id="infoModal">
        <div class="product-modal-new-content">
            <button class="close-btn-new" data-close-modal>&times;</button>
            <div class="product-modal-new-body">
                <div class="product-modal-image-wrapper">
                    <img src="assets/images/PulseiraInfo.png" alt="Pulseira Info">
                </div>
                <div class="product-modal-details-wrapper">
                    <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                    <h2>Pulseira de INFO - Design Minimalista</h2>
                    <p>
                        Uma pulseira elegante e discreta, perfeita para o dia a dia. 
                        Fabricada com borracha de alta qualidade, oferece conforto e durabilidade.
                    </p>
                    <div class="price-container">
                        <span class="product-price-new">R$ 9,99</span>
                        <span class="product-price-old">R$ 12,99</span>
                    </div>
                    <div class="quantity-selector-modal">
                        <button class="quantity-btn decrease">-</button>
                        <span class="quantity-value">1</span>
                        <button class="quantity-btn increase">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-comprar" data-id="info-01" data-name="Pulseira Informática" data-price="9.99" data-image="assets/images/PulseiraInfo.png">COMPRAR</button>
                        <button class="btn-add-cart add-to-cart-btn" data-id="info-01" data-name="Pulseira Informática" data-price="9.99" data-image="PulseiraInfo.png">ADICIONAR AO CARRINHO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="eletroModal">
        <div class="product-modal-new-content">
            <button class="close-btn-new" data-close-modal>&times;</button>
            <div class="product-modal-new-body">
                <div class="product-modal-image-wrapper">
                    <img src="assets/images/PulseiraEletro.png" alt="Pulseira Eletro">
                </div>
                <div class="product-modal-details-wrapper">
                    <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                    <h2>Pulseira de ELETRO - Energia e Precisão</h2>
                    <p>Mostre sua paixão por Eletrônica com esta pulseira vibrante. Feita para durar, 
                        ela simboliza a energia e a precisão dos circuitos.
                    </p>
                    <div class="price-container">
                        <span class="product-price-new">R$ 9,99</span>
                        <span class="product-price-old">R$ 12,99</span>
                    </div>
                    <div class="quantity-selector-modal">
                        <button class="quantity-btn decrease">-</button>
                        <span class="quantity-value">1</span>
                        <button class="quantity-btn increase">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-comprar" data-id="eletro-01" data-name="Pulseira Eletrônica" data-price="9.99" data-image="assets/images/PulseiraEletro.png">COMPRAR</button>
                        <button class="btn-add-cart add-to-cart-btn" data-id="eletro-01" data-name="Pulseira Eletrônica" data-price="9.99" data-image="assets/images/PulseiraEletro.png">ADICIONAR AO CARRINHO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="mecModal">
        <div class="product-modal-new-content">
            <button class="close-btn-new" data-close-modal>&times;</button>
            <div class="product-modal-new-body">
                <div class="product-modal-image-wrapper">
                    <img src="assets/images/PulseiraMec.png" alt="Pulseira Mecânica">
                </div>
                <div class="product-modal-details-wrapper">
                    <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                    <h2>Pulseira de MEC - Força e Engenhosidade</h2>
                    <p> Esta pulseira robusta representa a força, 
                        a durabilidade e a engenhosidade das grandes máquinas e projetos mecânicos.
                    </p>
                    <div class="price-container">
                        <span class="product-price-new">R$ 9,99</span>
                        <span class="product-price-old">R$ 12,99</span>
                    </div>
                    <div class="quantity-selector-modal">
                        <button class="quantity-btn decrease">-</button>
                        <span class="quantity-value">1</span>
                        <button class="quantity-btn increase">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-comprar" data-id="mec-01" data-name="Pulseira Mecânica" data-price="9.99" data-image="assets/images/PulseiraMec.png">COMPRAR</button>
                        <button class="btn-add-cart add-to-cart-btn" data-id="mec-01" data-name="Pulseira Mecânica" data-price="9.99" data-image="assets/images/PulseiraMec.png">ADICIONAR AO CARRINHO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="ctiModal">
        <div class="product-modal-new-content">
            <button class="close-btn-new" data-close-modal>&times;</button>
            <div class="product-modal-new-body">
                <div class="product-modal-image-wrapper">
                    <img src="assets/images/PulseiraCTI.png" alt="Pulseira CTI">
                </div>
                <div class="product-modal-details-wrapper">
                    <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                    <h2>Pulseira CTI - Orgulho de Ser</h2>
                    <p>O símbolo oficial de todos os cursos. Carregue o orgulho de fazer parte do CTI com esta pulseira clássica e mostre sua identidade.</p>
                    <div class="price-container">
                        <span class="product-price-new">R$ 9,99</span>
                        <span class="product-price-old">R$ 12,99</span>
                    </div>
                    <div class="quantity-selector-modal">
                        <button class="quantity-btn decrease">-</button>
                        <span class="quantity-value">1</span>
                        <button class="quantity-btn increase">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-comprar" data-id="cti-01" data-name="Pulseira CTI" data-price="9.99" data-image="assets/images/PulseiraCTI.png">COMPRAR</button>
                        <button class="btn-add-cart add-to-cart-btn" data-id="cti-01" data-name="Pulseira CTI" data-price="9.99" data-image="assets/images/PulseiraCTI.png">ADICIONAR AO CARRINHO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="comboModal">
        <div class="product-modal-new-content">
            <button class="close-btn-new" data-close-modal>&times;</button>
            <div class="product-modal-new-body">
                <div class="product-modal-image-wrapper">
                    <img src="assets/images/PulseiraCTI.png" alt="Combo Pulseiras">
                </div>
                <div class="product-modal-details-wrapper">
                    <img src="assets/images/logo-Photoroom.png" alt="PulsoTech" class="modal-logo">
                    <h2>Combo Pulseiras CTI</h2>
                    <p>Leve duas pulseiras do CTI com um desconto especial e mostre seu orgulho em dobro! Perfeito para usar e presentear um colega.</p>
                    <div class="price-container">
                        <span class="product-price-new">R$ 16,99</span>
                        <span class="product-price-old">R$ 25,98</span>
                    </div>
                    <div class="quantity-selector-modal">
                        <button class="quantity-btn decrease">-</button>
                        <span class="quantity-value">1</span>
                        <button class="quantity-btn increase">+</button>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-comprar" data-id="combo-01" data-name="Combo Pulseiras CTI" data-price="16.99" data-image="assets/images/PulseiraCTI.png">COMPRAR</button>
                        <button class="btn-add-cart add-to-cart-btn" data-id="combo-01" data-name="Combo Pulseiras CTI" data-price="16.99" data-image="assets/images/PulseiraCTI.png">ADICIONAR AO CARRINHO</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html> 