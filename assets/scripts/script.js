document.addEventListener('DOMContentLoaded', () => {

    // ===== LÓGICA DO MENU DROPDOWN DE USUÁRIO =====
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', (event) => {
            // Impede que o clique no próprio botão feche o menu
            event.stopPropagation(); 
            userDropdown.classList.toggle('active');
        });

        // Fecha o dropdown se o usuário clicar em qualquer outro lugar da página
        document.addEventListener('click', (event) => {
            if (!userDropdown.contains(event.target) && userDropdown.classList.contains('active')) {
                userDropdown.classList.remove('active');
            }
        });
    }

    // ===== GESTÃO DE TODOS OS MODAIS =====
    const allModals = document.querySelectorAll('.modal');

    function openModal(modal) {
        if (modal) {
            modal.classList.add('active');
        }
    }
    
    function closeModal(modal) {
        if (modal) {
            modal.classList.remove('active');
        }
    }

    // Gatilho ÚNICO para abrir TODOS os modais (Produtos, Login, Cadastro)
    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', () => {
            // Fecha o dropdown primeiro (se estiver aberto) antes de abrir o modal
            if (userDropdown) {
                userDropdown.classList.remove('active');
            }
            const modal = document.querySelector(trigger.dataset.modalTarget);
            openModal(modal);
        });
    });

    // Gatilho para fechar QUALQUER modal (pelo botão de fechar ou clicando fora)
    allModals.forEach(modal => {
        modal.addEventListener('click', e => {
            // Verifica se o clique foi no botão de fechar ou no fundo do modal
            if (e.target.hasAttribute('data-close-modal') || e.target === modal) {
                closeModal(modal);
            }
        });
    });

    // (Aqui pode entrar o resto do seu código, como a lógica do carrinho, etc.)
    // ...

    console.log('PulsoTech site inicializado com dropdown e modais ativos!');
});