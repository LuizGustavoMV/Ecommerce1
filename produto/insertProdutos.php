<?php
session_start();
include 'util.php';


// Validação básica dos dados recebidos.
if (empty($_POST['nome']) || empty($_POST['descricao']) || empty($_POST['valor_unitario']) || !isset($_FILES['imagem']) || $_FILES['imagem']['error'] != 0) {
    die("Erro: Todos os campos são obrigatórios e uma imagem deve ser enviada. <a href='adicionar_produto.php'>Voltar</a>");
}

try {
    // --- LÓGICA DE UPLOAD DA IMAGEM ---
    // Adaptei seu caminho de imagens, mas recomendo usar 'assets/images/products' para consistência.
    $target_dir = "assets/images/uploads/"; 
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $nome_arquivo_novo = "produto_" . uniqid() . "." . $ext;
    $caminho_completo = $target_dir . $nome_arquivo_novo;

    if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo)) {
        throw new Exception("Ocorreu um erro ao fazer o upload da imagem.");
    }

    // --- LÓGICA DE INSERÇÃO NO BANCO ---
    $conn = conecta();
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor_unitario = str_replace(',', '.', $_POST['valor_unitario']);
    // Precisamos remover o "../" do caminho para salvar no banco, por causa da tag <base>
    $caminho_imagem_db = str_replace('../', '', $caminho_completo);

    $sql = "INSERT INTO produto (nome, descricao, valor_unitario, imagem) 
            VALUES (:nome, :descricao, :valor_unitario, :imagem)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':valor_unitario', $valor_unitario);
    $stmt->bindParam(':imagem', $caminho_imagem_db);
    
    $stmt->execute();
    
    // Redireciona de volta para a lista de produtos após o sucesso.
    header("Location: produtos.php");
    exit();

} catch (Exception $e) {
    // Se deu erro em qualquer etapa, apaga a imagem que já foi enviada (se houver).
    if (isset($caminho_completo) && file_exists($caminho_completo)) {
        unlink($caminho_completo);
    }
    die("Erro: " . $e->getMessage() . " <a href='adicionar_produto.php'>Voltar</a>");
}
?>