document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA PARA ABRIR E FECHAR MODAIS ---
    const modalButtons = document.querySelectorAll('[data-modal-target]');
    const closeButtons = document.querySelectorAll('[data-close-modal]');

    modalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(button.dataset.modalTarget);
            openModal(modal);
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            closeModal(modal);
        });
    });

    function openModal(modal) {
        if (modal == null) return;
        modal.classList.add('active');
    }

    function closeModal(modal) {
        if (modal == null) return;
        modal.classList.remove('active');
    }
    
    // --- LÓGICA PARA O MENU DROPDOWN DO USUÁRIO ---
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');
    if(userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', () => {
            userDropdown.classList.toggle('active');
        });
        // Fecha o menu se clicar fora dele
        document.addEventListener('click', (e) => {
            if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
    }

    // =========================================================
    //       ✨ A MÁGICA DA QUANTIDADE ESTÁ AQUI ✨
    // =========================================================
    // --- LÓGICA PARA O SELETOR DE QUANTIDADE NOS MODAIS ---
    const quantitySelectors = document.querySelectorAll('.quantity-selector-modal');

    quantitySelectors.forEach(selector => {
        const decreaseBtn = selector.querySelector('.decrease');
        const increaseBtn = selector.querySelector('.increase');
        const quantitySpan = selector.querySelector('.quantity-value');
        
        // Encontra o botão "Adicionar ao Carrinho" DENTRO do mesmo modal
        const modal = selector.closest('.modal');
        const addToCartLink = modal.querySelector('.add-to-cart-btn');

        // Pega o link original sem a quantidade
        const baseLink = addToCartLink.getAttribute('href');

        const updateLink = (quantity) => {
            // Atualiza o href do link para incluir a quantidade
            addToCartLink.setAttribute('href', `${baseLink}&qtd=${quantity}`);
        };

        increaseBtn.addEventListener('click', () => {
            let currentQuantity = parseInt(quantitySpan.textContent);
            currentQuantity++;
            quantitySpan.textContent = currentQuantity;
            updateLink(currentQuantity);
        });

        decreaseBtn.addEventListener('click', () => {
            let currentQuantity = parseInt(quantitySpan.textContent);
            if (currentQuantity > 1) {
                currentQuantity--;
                quantitySpan.textContent = currentQuantity;
                updateLink(currentQuantity);
            }
        });

        // Garante que o link esteja correto quando o modal abre
        updateLink(1); 
    });
});