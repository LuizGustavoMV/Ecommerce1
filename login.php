<?php
// ADICIONADO PARA DEBUG: Mostra erros em vez de uma tela branca.
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "util.php";

    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $erro = "Por favor, preencha o e-mail e a senha.";
    } else {
        $email = $_POST['email'];
        $senha_digitada = $_POST['senha']; 
        
        try {
            $conn = conecta();
            $sql = "SELECT id_usuario, nome, senha, admin FROM usuario WHERE email = :email AND excluido = false";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
                // Sucesso! Regenera a sessão e guarda as informações.
                session_regenerate_id(true);
                $_SESSION['statusConectado'] = true;
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nome_usuario'] = $usuario['nome'];
                $_SESSION['admin'] = (bool)$usuario['admin'];

                // =========================================================
                //       ✨ LÓGICA CORRIGIDA PARA MESCLAR O CARRINHO ✨
                // =========================================================
                if (!empty($_SESSION['carrinho'])) {
                    $id_usuario_logado = $_SESSION['id_usuario'];

                    $stmt_compra = $conn->prepare("SELECT id_compra FROM compra WHERE fk_usuario = :id_usuario AND status = 'carrinho'");
                    $stmt_compra->execute([':id_usuario' => $id_usuario_logado]);
                    $compra_ativa = $stmt_compra->fetch();

                    if ($compra_ativa) {
                        $id_compra = $compra_ativa['id_compra'];
                    } else {
                        $stmt_nova = $conn->prepare("INSERT INTO compra (fk_usuario, status, sessao) VALUES (:id_usuario, 'carrinho', :sessao)");
                        $stmt_nova->execute([':id_usuario' => $id_usuario_logado, ':sessao' => session_id()]);
                        $id_compra = $conn->lastInsertId();
                    }

                    foreach ($_SESSION['carrinho'] as $id_produto => $item_sessao) {
                        $stmt_item = $conn->prepare("SELECT quantidade FROM compra_produto WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                        $stmt_item->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto]);
                        $item_db = $stmt_item->fetch();
                        
                        if($item_db){
                            $nova_qtd = $item_db['quantidade'] + $item_sessao['quantidade'];
                            $stmt_update = $conn->prepare("UPDATE compra_produto SET quantidade = :qtd WHERE fk_compra = :id_compra AND fk_produto = :id_produto");
                            $stmt_update->execute([':qtd' => $nova_qtd, ':id_compra' => $id_compra, ':id_produto' => $id_produto]);
                        } else {
                            $stmt_insert = $conn->prepare("INSERT INTO compra_produto (fk_compra, fk_produto, quantidade, valor_unitario) VALUES (:id_compra, :id_produto, :qtd, :valor)");
                            $stmt_insert->execute([':id_compra' => $id_compra, ':id_produto' => $id_produto, ':qtd' => $item_sessao['quantidade'], ':valor' => $item_sessao['preco']]);
                        }
                    }
                    
                    unset($_SESSION['carrinho']);
                }
                // =========================================================
                
                // Redireciona para o carrinho para o usuário ver seus itens.
                header("Location: home.php"); 
                exit();
            } else {
                $erro = "E-mail ou senha inválidos.";
            }
        } catch (PDOException $e) {
            $erro = "Ocorreu um erro no servidor. Tente novamente mais tarde.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PulsoTech</title>
    
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "nav.php"; ?>
    <main class="main-content">
        <div class="auth-container">
            <div class="auth-box">
                <div class="user-icon"><i class="fas fa-user-circle"></i></div>
                <h2>Iniciar Sessão</h2>

                <?php if (isset($erro)): ?>
                    <div class="auth-error-message">
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>

                <form class="auth-form" method="POST" action="login.php">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="auth-btn">Entrar</button>
                </form>
                <p class="auth-switch-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                <p class="auth-switch-link"><a href="esqueci.php">Esqueci minha senha</a></p>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?> 
    <script src="assets/scripts/script.js"></script>
</body>
</html>