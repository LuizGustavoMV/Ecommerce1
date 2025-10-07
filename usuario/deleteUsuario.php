<?php
include ("util.php");
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
    header("Location: ../home.php");
    exit();
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die("ID inválido.");
}

$conn = conecta();
$sql = "UPDATE usuario SET excluido = TRUE, data_exclusao = CURRENT_TIMESTAMP WHERE id_usuario = :id";
    
$update = $conn->prepare($sql);
$update->bindParam(':id', $id);
$update->execute();

header("Location: usuarios.php");
exit();
?>