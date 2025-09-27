<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTI - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
     <?php include "nav.php"; ?>

    <main class="main-content">
        <section class="cti-section">
            <div class="container">
                <div class="cti-content">
                    <div class="cti-text">
                        <h2>O Colégio Técnico Industrial "Prof. Isaac Portal Roldán" (CTI)</h2>
                        <p>É uma instituição de ensino vinculada à Unesp – Universidade Estadual Paulista, localizada em Bauru/SP.</p>
                        <p>A escola oferece cursos em diversas áreas, como: Informática, Mecânica e Eletrônica.</p>
                        <p>Com laboratórios modernos, projetos interdisciplinares e incentivo ao empreendedorismo, o CTI se destaca por formar profissionais capazes de enfrentar os desafios da tecnologia e da indústria, sempre com uma visão crítica e criativa.</p>
                        <p>Foi nesse ambiente inovador que nasceu a Pulso Tech, uma startup desenvolvida por alunos do curso técnico de Informática como forma de aplicar, na prática, os conhecimentos adquiridos em sala de aula.</p>
                    </div>
                    <div class="cti-images">
                        <div class="cti-image-placeholder">
                             <img src="assets/images/Cti_01.jpg" alt="Imagem do CTI">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal" id="loginModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="logo img"><img src="assets/images/logo-Photoroom.png" alt="Logo">
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
    </div> <!--</div> -->
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

    <script src="assets/scripts/script.js"></script>
    <?php include "footer.php"; ?> 
</body>
</html>