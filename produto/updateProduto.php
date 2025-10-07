<?php
session_start();
include '../util.php';


// Validação básica dos dados recebidos.
if (empty($_POST['id_produto']) || empty($_POST['nome']) || empty($_POST['descricao']) || empty($_POST['valor_unitario'])) {
    die("Erro: Dados incompletos. <a href='produtos.php'>Voltar</a>");
}

$id_produto = $_POST['id_produto'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$valor_unitario = str_replace(',', '.', $_POST['valor_unitario']); // Converte vírgula para ponto
$caminho_imagem_db = $_POST['imagem_atual']; // Assume a imagem atual por padrão

try {
    // --- LÓGICA DE ATUALIZAÇÃO DA IMAGEM ---
    // Verifica se uma NOVA imagem foi enviada e não teve erros.
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        
        // CORREÇÃO: O caminho precisa "subir" um nível para sair da pasta 'admin'.
        $target_dir = "../imagens/produtos/"; 
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_arquivo_novo = "produto_" . uniqid() . "." . $ext;
        $caminho_completo_novo = $target_dir . $nome_arquivo_novo;

        // Tenta mover o novo arquivo.
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_completo_novo)) {
            // Se o upload deu certo, apaga a imagem antiga.
            // CORREÇÃO: O caminho para apagar também precisa "subir" um nível.
            $caminho_antigo_completo = "../" . $_POST['imagem_atual'];
            if (file_exists($caminho_antigo_completo)) {
                unlink($caminho_antigo_completo);
            }
            
            // Define o caminho da NOVA imagem para salvar no banco.
            // Remove o "../" para que o caminho funcione com a tag <base> do seu site.
            $caminho_imagem_db = str_replace('../', '', $caminho_completo_novo);
        } else {
            // Se falhar, lança um erro.
            throw new Exception("Erro ao mover o novo arquivo de imagem.");
        }
    }

    // --- LÓGICA DE ATUALIZAÇÃO NO BANCO ---
    $conn = conecta();
    $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, valor_unitario = :valor_unitario, imagem = :imagem 
            WHERE id_produto = :id_produto";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':valor_unitario', $valor_unitario);
    $stmt->bindParam(':imagem', $caminho_imagem_db);
    $stmt->bindParam(':id_produto', $id_produto);
    
    $stmt->execute();
    
    // Redireciona de volta para a lista de produtos.
    header("Location: produtos.php");
    exit();

} catch (Exception $e) {
    // Se ocorrer qualquer erro, exibe uma mensagem amigável.
    die("Erro ao atualizar o produto: " . $e->getMessage() . " <a href='produtos.php'>Voltar</a>");
}
?>