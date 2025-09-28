document.addEventListener('DOMContentLoaded', () => {

    // ===== LÓGICA DO MENU DROPDOWN DE USUÁRIO =====
    const userMenuBtn = document.getElementById('userMenuBtn');
    const userDropdown = document.getElementById('userDropdown');

    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            userDropdown.classList.toggle('active');
        });

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

    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', () => {
            if (userDropdown) {
                userDropdown.classList.remove('active');
            }
            const modal = document.querySelector(trigger.dataset.modalTarget);
            openModal(modal);
        });
    });

    allModals.forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target.hasAttribute('data-close-modal') || e.target === modal) {
                closeModal(modal);
            }
        });
    });
    
    // ===== LÓGICA DO FORMULÁRIO DE CONTATO (SUPORTE) =====
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        const confirmacaoModal = document.getElementById('confirmacaoModal');
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            contactForm.reset();
            openModal(confirmacaoModal);
        });
    }


    // ===== LÓGICA INTERATIVA PARA OS MODAIS DE PRODUTO =====
    
    // --- Seletor de Quantidade (+ e -) ---
    const todosOsSeletores = document.querySelectorAll('.quantity-selector-modal');

    todosOsSeletores.forEach(seletor => {
        const btnDiminuir = seletor.querySelector('.decrease');
        const btnAumentar = seletor.querySelector('.increase');
        const valorQuantidade = seletor.querySelector('.quantity-value');

        if (btnDiminuir && btnAumentar && valorQuantidade) {
            btnAumentar.addEventListener('click', () => {
                let quantidadeAtual = parseInt(valorQuantidade.textContent);
                quantidadeAtual++;
                valorQuantidade.textContent = quantidadeAtual;
            });

            btnDiminuir.addEventListener('click', () => {
                let quantidadeAtual = parseInt(valorQuantidade.textContent);
                if (quantidadeAtual > 1) {
                    quantidadeAtual--;
                    valorQuantidade.textContent = quantidadeAtual;
                }
            });
        }
    });

    // --- Botões de Ação (Comprar e Adicionar ao Carrinho) ---
    const todosOsBotoesComprar = document.querySelectorAll('.btn-comprar');
    const todosOsBotoesAdicionar = document.querySelectorAll('.btn-add-cart');

    todosOsBotoesComprar.forEach(botao => {
        botao.addEventListener('click', () => {
            const produtoId = botao.dataset.id;
            const seletor = botao.closest('.product-modal-details-wrapper').querySelector('.quantity-value');
            const quantidade = parseInt(seletor.textContent);

            console.log(`Simulando COMPRA: Produto ID: ${produtoId}, Quantidade: ${quantidade}`);
            alert(`Simulação de Compra:\nProduto: ${produtoId}\nQuantidade: ${quantidade}`);
        });
    });

    todosOsBotoesAdicionar.forEach(botao => {
        botao.addEventListener('click', () => {
            const produtoId = botao.dataset.id;
            const produtoNome = botao.dataset.name;
            const seletor = botao.closest('.product-modal-details-wrapper').querySelector('.quantity-value');
            const quantidade = parseInt(seletor.textContent);

            console.log(`Simulando ADIÇÃO AO CARRINHO: Produto ID: ${produtoId}, Nome: ${produtoNome}, Quantidade: ${quantidade}`);
            
            const textoOriginal = botao.textContent;
            botao.textContent = 'ADICIONADO!';
            botao.style.backgroundColor = '#10b981';
            botao.style.borderColor = '#10b981';
            botao.style.color = 'white';

            setTimeout(() => {
                botao.textContent = textoOriginal;
                botao.style.backgroundColor = '';
                botao.style.borderColor = '';
                botao.style.color = '';
            }, 2000);
        });
    });

    console.log('PulsoTech site inicializado com todas as funções ativas!');
});