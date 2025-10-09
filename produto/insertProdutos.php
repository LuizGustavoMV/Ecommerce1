<?php
session_start();
include 'util.php';


// Validação. Note que agora verificamos 'imagem_nome'.
if (empty($_POST['nome']) || empty($_POST['descricao']) || empty($_POST['valor_unitario']) || empty($_POST['imagem_nome'])) {
    die("Erro: Todos os campos são obrigatórios. <a href='adicionarProduto.php'>Voltar</a>");
}

try {
    // --- LÓGICA DE REFERÊNCIA DE IMAGEM (SEM UPLOAD) ---
    $nome_arquivo_imagem = $_POST['imagem_nome'];
    $pasta_base_imagens = "assets/images/";

    // Monta o caminho relativo à raiz do site, que será salvo no banco
    $caminho_imagem_db = $pasta_base_imagens . $nome_arquivo_imagem;

    // Monta o caminho físico no disco para o PHP poder verificar se o arquivo existe
    // Sai da pasta 'produto' (../) e entra em 'assets/images/'
    $caminho_fisico_arquivo =  $caminho_imagem_db;

    // VERIFICAÇÃO CRÍTICA: Checa se a imagem realmente existe na pasta
    if (!file_exists($caminho_fisico_arquivo)) {
        throw new Exception("A imagem '" . htmlspecialchars($nome_arquivo_imagem) . "' não foi encontrada na pasta `assets/images/`. Verifique o nome do arquivo e se você a enviou para o servidor.");
    }

    // --- LÓGICA DE INSERÇÃO NO BANCO ---
    $conn = conecta();
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor_unitario = str_replace(',', '.', $_POST['valor_unitario']);

    $sql = "INSERT INTO produto (nome, descricao, valor_unitario, imagem) 
            VALUES (:nome, :descricao, :valor_unitario, :imagem)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':valor_unitario', $valor_unitario);
    $stmt->bindParam(':imagem', $caminho_imagem_db);
    
    $stmt->execute();
    
    header("Location: produtos.php?sucesso=add");
    exit();

} catch (Exception $e) {
    die("Erro: " . $e->getMessage() . " <a href='adicionarProduto.php'>Voltar</a>");
}
?>