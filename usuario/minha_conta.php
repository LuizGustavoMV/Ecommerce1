<?php
session_start();
// CAMINHO CORRIGIDO: "Sobe" um nível para encontrar o util.php
include '../util.php';

// Segurança: Se o usuário não estiver logado, redireciona para o login.
if (!isset($_SESSION['statusConectado']) || $_SESSION['statusConectado'] !== true) {
    // CAMINHO CORRIGIDO: Redireciona para a página de login na raiz
    header('Location: ../login.php?redirect=usuario/minha_conta.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$mensagem = '';
$cor_mensagem = '';

// Lógica para ATUALIZAR os dados (sem alterações na lógica, apenas nos caminhos)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'] ?? null;
    
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];
    $novaSenhaHash = null;

    if (!empty($nova_senha)) {
        if (empty($senha_atual) || $nova_senha !== $confirma_senha) {
            $mensagem = "Para alterar a senha, forneça a senha atual e as novas senhas devem ser iguais.";
            $cor_mensagem = 'red';
        } else {
            try {
                $conn = conecta();
                $stmt = $conn->prepare("SELECT senha FROM usuario WHERE id_usuario = :id");
                $stmt->execute([':id' => $id_usuario]);
                $usuario_senha = $stmt->fetch();
                
                if ($usuario_senha && password_verify($senha_atual, $usuario_senha['senha'])) {
                    $novaSenhaHash = password_hash($nova_senha, PASSWORD_DEFAULT);
                } else {
                    $mensagem = "A senha atual está incorreta.";
                    $cor_mensagem = 'red';
                }
            } catch (PDOException $e) {
                $mensagem = "Erro ao verificar a senha.";
                $cor_mensagem = 'red';
            }
        }
    }

    if (empty($mensagem)) {
        try {
            $conn = conecta();
            $sql = "UPDATE usuario SET nome = :nome, email = :email, telefone = :telefone";
            $params = [':nome' => $nome, ':email' => $email, ':telefone' => $telefone, ':id_usuario' => $id_usuario];

            if ($novaSenhaHash) {
                $sql .= ", senha = :senha";
                $params[':senha'] = $novaSenhaHash;
            }

            $sql .= " WHERE id_usuario = :id_usuario";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            
            $_SESSION['nome_usuario'] = $nome;
            $mensagem = "Dados atualizados com sucesso!";
            $cor_mensagem = 'green';

        } catch (PDOException $e) {
            $mensagem = "Erro ao atualizar os dados. O e-mail informado pode já estar em uso.";
            $cor_mensagem = 'red';
        }
    }
}

// Lógica para BUSCAR os dados atuais do usuário
try {
    $conn = conecta();
    $stmt = $conn->prepare("SELECT nome, email, telefone FROM usuario WHERE id_usuario = :id");
    $stmt->execute([':id' => $id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar dados do usuário.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - PulsoTech</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // CAMINHO CORRIGIDO: "Sobe" um nível para encontrar o nav.php
    include '../nav.php'; 
    ?>

    <main class="main-content">
        <div class="admin-container">
            <h1>Minha Conta</h1>

            <?php if ($mensagem): ?>
                <p style="padding: 15px; border-radius: 5px; color: white; background-color: <?php echo $cor_mensagem; ?>; text-align: center; margin-bottom: 20px;">
                    <?php echo htmlspecialchars($mensagem); ?>
                </p>
            <?php endif; ?>

            <div class="auth-box" style="max-width: none; margin: 0;">
                <form class="auth-form" method="POST" action="usuario/minha_conta.php">
                    <fieldset class="form-fieldset">
                        <legend>Dados Pessoais</legend>
                        <div class="form-group">
                            <label for="nome">Nome Completo:</label>
                            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>">
                        </div>
                    </fieldset>
                    <fieldset class="form-fieldset">
                        <legend>Alterar Senha (Opcional)</legend>
                        <p style="font-size: 14px; color: var(--gray-500); margin-bottom: 15px;">Deixe os campos abaixo em branco se não quiser alterar sua senha.</p>
                        <div class="form-group">
                            <label for="senha_atual">Senha Atual:</label>
                            <input type="password" id="senha_atual" name="senha_atual" placeholder="Digite sua senha atual para confirmar">
                        </div>
                        <div class="form-group">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" id="nova_senha" name="nova_senha" placeholder="Mínimo de 6 caracteres">
                        </div>
                        <div class="form-group">
                            <label for="confirma_senha">Confirme a Nova Senha:</label>
                            <input type="password" id="confirma_senha" name="confirma_senha">
                        </div>
                    </fieldset>
                    <button type="submit" class="auth-btn">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </main>

    <?php 
    // CAMINHO CORRIGIDO: "Sobe" um nível para encontrar o footer.php
    include '../footer.php'; 
    ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>