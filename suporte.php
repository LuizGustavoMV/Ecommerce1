<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <section class="support-section">
            <div class="container">
                <div class="support-content">
                    <div class="faq-section">
                        <h2>FAQ</h2>
                        <div class="faq-item">MATERIAL DAS PULSEIRAS</div>
                        <div class="faq-item">COMO CRIAR SUA CONTA</div>
                        <div class="faq-item">HORÁRIO DE ATENDIMENTO</div>
                    </div>
                    <div class="contact-section">
                        <h2>FALE CONOSCO</h2>
                        <form class="contact-form">
                            <input type="text" placeholder="NOME" required>
                            <input type="email" placeholder="EMAIL" required>
                            <input type="text" placeholder="ASSUNTO" required>
                            <textarea placeholder="MENSAGEM" required></textarea>
                            <button type="submit">ENVIAR</button>
                        </form>
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
            </div>
            <form class="auth-form">
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
            </div><div class="user-icon"><i class="fas fa-user-circle"></i>
            </div>
            <form class="auth-form">
                <div class="form-group"><label>Nome:</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>e-mail:</label>
                    <input type="email" required>
                </div>
                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" required>
                </div>
                <button type="submit" class="auth-btn">CADASTRAR-SE</button>
            </form>
        </div>
    </div>

    <div class="modal" id="infoModal">...</div>
    <div class="modal" id="eletroModal">...</div>
    <div class="modal" id="mecModal">...</div>
    <div class="modal" id="ctiModal">...</div>
    <div class="modal" id="comboModal">...</div>

    <script src="assets/scripts/script.js"></script>

    <?php include "footer.php"; ?> 
</body>
</html>