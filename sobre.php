<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - PulsoTech</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/components/modal.css">

    <link rel="stylesheet" href="assets/css/pages/sobre.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>

    <main class="main-content">
        <section class="about-section">
            <div class="container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>Na Pulso Tech, unimos inovação, criatividade e espírito empreendedor para transformar ideias em realidade.</h2>
                        
                        <h3>Missão</h3>
                        <p>Oferecer pulseiras exclusivas que representem os cursos do CTI, unindo inovação, criatividade e tecnologia para valorizar a experiência estudantil, fortalecer o sentimento de pertencimento e transformar ideias em produtos que carregam significado e identidade.</p>
                        
                        <h3>Visão</h3>
                        <p>Representar a identidade dos cursos do CTI por meio de produtos criativos e simbólicos, deixando uma marca positiva e memorável na trajetória acadêmica dos estudantes.</p>
                    </div>
                    <div class="about-icon">
                        <i class="fas fa-bullhorn"></i>
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
            </div>
            <div class="user-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <form class="auth-form">
                <div class="form-group">
                    <label>Nome:</label>
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

    <?php include "footer.php" ?>
    <script src="assets/scripts/script.js"></script>
    
</body>
</html>