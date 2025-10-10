<?php
session_start();
// O caminho para o util.php precisa "subir" um nível de pasta.
include "util.php";



// Lógica para buscar os usuários no banco
try {
    $conn = conecta();
    $sql = "SELECT id_usuario, nome, email, telefone, admin FROM usuario WHERE excluido = FALSE ORDER BY nome ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro = "Ocorreu um erro ao buscar os usuários.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    
    <base href="http://localhost:3000/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários - Admin</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/components/header.css">
    <link rel="stylesheet" href="assets/css/components/footer.css">
    <link rel="stylesheet" href="assets/css/pages/admin.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // O include do PHP ainda precisa do ../ para encontrar o nav.php na pasta raiz
    include "../nav.php"; 
    ?>

    <main class="main-content">
        <div class="admin-container">
            <h1>Gerenciamento de Usuários</h1>

            <a href="usuario/adicionarUsuario.php" class="add-btn"><i class="fas fa-plus"></i> Adicionar Novo Usuário</a>

            <?php if (isset($erro)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
            <?php elseif (empty($usuarios)): ?>
                <p>Nenhum usuário encontrado.</p>
            <?php else: ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Admin</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td data-label="ID"><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                                <td data-label="Nome"><?php echo htmlspecialchars($usuario['nome']); ?></td>
                                <td data-label="E-mail"><?php echo htmlspecialchars($usuario['email']); ?></td>
                                <td data-label="Telefone"><?php echo htmlspecialchars($usuario['telefone'] ?? 'N/A'); ?></td>
                                <td data-label="Admin"><?php echo $usuario['admin'] ? 'Sim' : 'Não'; ?></td>
                                <td data-label="Ações">
                                    <a href="usuario/alterarUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-btn edit-btn" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="usuario/deleteUsuario.php?id=<?php echo $usuario['id_usuario']; ?>" class="action-btn delete-btn" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <?php 
    include "../footer.php"; 
    ?>
    <script src="assets/scripts/script.js"></script>
</body>
</html>