<?php
session_start();
// A sua lógica de segurança original
if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
    header("Location: ../home.php");
    exit();
}


include "../util.php"; 

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de usuário inválido!");
}

$conn = conecta();
$sql = "SELECT * FROM usuario WHERE id_usuario = :id";
$select = $conn->prepare($sql);
$select->bindParam(':id', $id);
$select->execute();
$user = $select->fetch();

if (!$user) {
    die("Usuário não encontrado!");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Usuário - <?php echo htmlspecialchars($user['nome']); ?></title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // Seu include original para o nav/header
    // Supondo que este arquivo esteja em /usuario/, o include precisa ser ../nav.php
    include '../nav.php'; 
    ?>
    <main class="main-content">
        <div class="admin-container">
            <h1>Alterar Usuário</h1>
            <a href="usuario/usuarios.php" class="add-btn" style="background: var(--gray-600); margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Voltar para a Lista</a>

            <div class="auth-box" style="max-width: none; margin: 0; text-align: left;">
                <form class="auth-form" method='post' action='usuario/updateUsuarios.php'>
                    <input type='hidden' name='id_usuario' value='<?php echo $user['id_usuario']; ?>'>
                    
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value='<?php echo htmlspecialchars($user['nome']); ?>' required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type='email' id='email' name='email' value='<?php echo htmlspecialchars($user['email']); ?>' required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type='tel' id='telefone' name='telefone' value='<?php echo htmlspecialchars($user['telefone'] ?? ''); ?>'>
                    </div>

                    <div class="form-group">
                        <label for="senha">Nova Senha:</label>
                        <input type='password' id='senha' name='senha' placeholder="Deixe em branco para não alterar">
                    </div>
                    
                    <div class="form-group">
                        <label for="admin">Tipo de Usuário:</label>
                        <select name="admin" id="admin" class="form-group input" style="padding: var(--spacing-md); width:100%; border: 2px solid var(--gray-200); border-radius: var(--radius-lg); font-size: 16px; background: var(--gray-50);">
                            <?php $isAdmin = ($user['admin'] == true); ?>
                            <option value="1" <?php echo $isAdmin ? 'selected' : ''; ?>>Sim</option>
                            <option value="0" <?php echo !$isAdmin ? 'selected' : ''; ?>>Não</option>
                        </select>
                    </div>

                    <button type="submit" class="auth-btn">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>