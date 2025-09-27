document.addEventListener('DOMContentLoaded', () => {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const saveCart = () => localStorage.setItem('cart', JSON.stringify(cart));

    // Função para adicionar item (agora aceita quantidade)
    const addToCart = (product, quantity) => {
        const existingItem = cart.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({ ...product, quantity: quantity });
        }
        saveCart();
        updateCartIcon();
    };

    // Função para atualizar o ícone do carrinho
    const updateCartIcon = () => {
        const cartCounter = document.getElementById('cartCounter');
        if (cartCounter) {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCounter.textContent = totalItems;
        }
    };
    
    // LÓGICA PARA O SELETOR DE QUANTIDADE NOS MODAIS
    const handleQuantityButtons = () => {
        document.querySelectorAll('.quantity-selector-modal').forEach(selector => {
            const decreaseBtn = selector.querySelector('.decrease');
            const increaseBtn = selector.querySelector('.increase');
            const valueSpan = selector.querySelector('.quantity-value');

            decreaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(valueSpan.textContent);
                if (currentValue > 1) {
                    valueSpan.textContent = currentValue - 1;
                }
            });

            increaseBtn.addEventListener('click', () => {
                let currentValue = parseInt(valueSpan.textContent);
                valueSpan.textContent = currentValue + 1;
            });
        });
    };

    // LÓGICA PARA OS BOTÕES DE AÇÃO DOS MODAIS DE PRODUTO
    const addModalActionListeners = () => {
        document.querySelectorAll('.product-modal-new-content').forEach(modal => {
            const addToCartBtn = modal.querySelector('.btn-add-cart');
            const buyNowBtn = modal.querySelector('.btn-comprar');
            
            // Botão "ADICIONAR AO CARRINHO"
            addToCartBtn.addEventListener('click', (e) => {
                const quantity = parseInt(modal.querySelector('.quantity-value').textContent);
                const product = { ...e.target.dataset };
                
                addToCart(product, quantity);
                
                // Feedback visual
                e.target.textContent = 'ADICIONADO!';
                setTimeout(() => { e.target.textContent = 'ADICIONAR AO CARRINHO'; }, 2000);
            });

            // Botão "COMPRAR"
            buyNowBtn.addEventListener('click', (e) => {
                const quantity = parseInt(modal.querySelector('.quantity-value').textContent);
                const product = { ...e.target.dataset };

                addToCart(product, quantity);
                
                // Redireciona para o carrinho
                window.location.href = 'carrinho.html';
            });
        });
    };

    // ===== GESTÃO DE TODOS OS MODAIS (LOGIN, CADASTRO, PRODUTO) =====
    const allModals = document.querySelectorAll('.modal');
    
    function openModal(modal) {
        if (modal) {
            // Reseta a quantidade para 1 toda vez que abre um modal de produto
            const quantityValue = modal.querySelector('.quantity-value');
            if (quantityValue) {
                quantityValue.textContent = '1';
            }
            modal.classList.add('active');
        }
    }
    
    function closeModal(modal) {
        if (modal) modal.classList.remove('active');
    }

    // Gatilhos para abrir os modais de PRODUTO
    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modal = document.querySelector(trigger.dataset.modalTarget);
            openModal(modal);
        });
    });

    // Gatilhos para abrir os modais de LOGIN e CADASTRO
    document.getElementById('loginBtn')?.addEventListener('click', () => openModal(document.getElementById('loginModal')));
    document.getElementById('registerBtn')?.addEventListener('click', () => openModal(document.getElementById('registerModal')));

    // Gatilho para fechar QUALQUER modal
    allModals.forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target.closest('[data-close-modal]') || e.target === modal) {
                closeModal(modal);
            }
        });
    });

    // ===== INICIALIZAÇÃO E OUTRAS FUNÇÕES =====
    updateCartIcon();
    handleQuantityButtons();
    addModalActionListeners();
    // (Aqui entraria a lógica do carrinho.html, se estivéssemos nessa página)
    if (document.getElementById('cartItemsContainer')) {
        // Funções da página do carrinho, se houver
    }
    
    console.log('PulsoTech site inicializado!');
});