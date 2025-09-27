<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                        <p>Somos uma startup criada por alunos do curso técnico em Informática do CTI, com o objetivo de aplicar nossos aprendizados em um projeto prático e colaborativo.</p>
                        <p>Nosso foco é o desenvolvimento de um e-commerce moderno e acessível, onde oferecemos pulseiras exclusivas que representam os cursos do CTI. Cada produto carrega significado, identidade e a energia de quem faz parte dessa trajetória acadêmica.</p>
                        <p>Além de vender pulseiras, nossa missão é valorizar a experiência estudantil, fortalecer o sentimento de pertencimento e mostrar que tecnologia também pode caminhar lado a lado com criatividade e estilo.</p>
                    </div>
                    <div class="about-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal" id="loginModal"><div class="modal-content"><div class="modal-header"><div class="logo img"><img src="assets/images/logo-Photoroom.png" alt="Logo"></div><button class="close-btn" data-close-modal>&times;</button></div><div class="user-icon"><i class="fas fa-user-circle"></i></div><form class="auth-form"><div class="form-group"><label>e-mail:</label><input type="email" required></div><div class="form-group"><label>Senha:</label><input type="password" required></div><button type="submit" class="auth-btn">INICIAR SESSÃO</button></form></div></div>
    <div class="modal" id="registerModal"><div class="modal-content"><div class="modal-header"><div class="logo img"><img src="assets/images/logo-Photoroom.png" alt="Logo"></div><button class="close-btn" data-close-modal>&times;</button></div><div class="user-icon"><i class="fas fa-user-circle"></i></div><form class="auth-form"><div class="form-group"><label>Nome:</label><input type="text" required></div><div class="form-group"><label>e-mail:</label><input type="email" required></div><div class="form-group"><label>Senha:</label><input type="password" required></div><button type="submit" class="auth-btn">CADASTRAR-SE</button></form></div></div>

    <div class="modal" id="infoModal">...</div>
    <div class="modal" id="eletroModal">...</div>
    <div class="modal" id="mecModal">...</div>
    <div class="modal" id="ctiModal">...</div>
    <div class="modal" id="comboModal">...</div>

    <?php include "footer.php" ?>
    <script src="assets/scripts/script.js"></script>
    
</body>
</html>