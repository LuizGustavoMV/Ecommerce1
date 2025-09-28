<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - PulsoTech</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/components/modal.css">

    <link rel="stylesheet" href="assets/css/pages/suporte.css">

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
                        <div class="faq-item" data-modal-target="#faqMaterialModal">MATERIAL DAS PULSEIRAS</div>
                        <div class="faq-item" data-modal-target="#faqContaModal">COMO CRIAR SUA CONTA</div>
                        <div class="faq-item" data-modal-target="#faqAtendimentoModal">HORÁRIO DE ATENDIMENTO</div>
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

    <div class="modal" id="faqMaterialModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Material das Pulseiras</h2>
                <button class="close-btn" data-close-modal>&times;</button>
            </div>
            <div style="text-align: left; margin-top: 20px;">
                <p>Nossas pulseiras são fabricadas com borracha de silicone de alta qualidade, um material hipoalergênico, flexível e extremamente durável.</p>
                <p>Elas são resistentes à água e ao suor, perfeitas para o uso diário, seja em sala de aula, no trabalho ou durante atividades físicas. O material também garante que as cores permaneçam vibrantes por muito tempo.</p>
            </div>
        </div>
    </div>

    <div class="modal" id="faqContaModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Como Criar Sua Conta</h2>
                <button class="close-btn" data-close-modal>&times;</button>
            </div>
            <div style="text-align: left; margin-top: 20px;">
                <p>É muito simples criar sua conta na PulsoTech!</p>
                <ol>
                    <li>No canto superior direito de qualquer página, clique no ícone de usuário.</li>
                    <li>No menu que aparecer, clique em "Cadastrar".</li>
                    <li>Preencha seu nome, e-mail e crie uma senha segura.</li>
                    <li>Pronto! Sua conta será criada e você já poderá fazer suas compras.</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="modal" id="faqAtendimentoModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Horário de Atendimento</h2>
                <button class="close-btn" data-close-modal>&times;</button>
            </div>
            <div style="text-align: left; margin-top: 20px;">
                <p>Por sermos uma startup gerida por alunos, nosso horário de atendimento é flexível e acompanha a Semana do Colégio no <strong>Colégio Técnico Industrial "Prof. Isaac Portal Roldán"</strong>.</p>
                <p>Isso significa que não temos um horário comercial fixo, mas estamos sempre de olho nas mensagens! Garantimos que todas as dúvidas enviadas pelo formulário de contato serão respondidas o mais rápido possível ao longo de diversos períodos durante a semana letiva.</p>
            </div>
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