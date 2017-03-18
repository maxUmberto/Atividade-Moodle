<?php
//conexao com o banco de dados
include 'config.php';
    
if(isset($_GET['id']) && !empty($_GET['id'])){
    //variável id recebe o id enviado
    $id = $_GET['id'];
    
    //deleta o usuário do banco de dados
    $sql = "DELETE FROM usuario WHERE id = '$id'";
    $sql = $pdo -> query($sql);
    
    //redireciona para a index
    header('Location: index.php?excluido=1');
}
?>