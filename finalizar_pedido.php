<?php
session_start();
include 'util.php';

// 1. Segurança: Garante que o usuário está logado.
if (!isset($_SESSION['statusConectado']) || $_SESSION['statusConectado'] !== true) {
    header('Location: login.php?redirect=carrinho.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

try {
    $conn = conecta();

    // 2. Encontra a "compra" ativa do usuário que está com o status 'carrinho'.
    $sql_find_cart = "SELECT id_compra FROM compra WHERE fk_usuario = :id_usuario AND status = 'carrinho'";
    $stmt_find_cart = $conn->prepare($sql_find_cart);
    $stmt_find_cart->execute([':id_usuario' => $id_usuario]);
    $compra_ativa = $stmt_find_cart->fetch();

    // 3. Verifica se existe um carrinho para finalizar.
    if (!$compra_ativa) {
        // Se não encontrou um carrinho ativo, não há o que finalizar.
        // Isso pode acontecer se o usuário abrir a URL diretamente.
        header('Location: carrinho.php?erro=nao_encontrado');
        exit();
    }

    $id_compra_a_finalizar = $compra_ativa['id_compra'];

    // 4. AÇÃO PRINCIPAL: Atualiza o status da compra de 'carrinho' para 'reservado'.
    // É isso que "finaliza" o pedido e "zera" o carrinho.
    $sql_update_status = "UPDATE compra SET status = 'reservado' WHERE id_compra = :id_compra";
    $stmt_update_status = $conn->prepare($sql_update_status);
    $stmt_update_status->execute([':id_compra' => $id_compra_a_finalizar]);

    // 5. Redireciona para a página de "Meus Pedidos" com a mensagem de sucesso.
    header('Location: meus_pedidos.php?sucesso=1');
    exit();

} catch (PDOException $e) {
    // Se der qualquer erro no banco, exibe uma mensagem.
    die("Erro ao finalizar o pedido. Por favor, tente novamente. Detalhe: " . $e->getMessage());
}
?>