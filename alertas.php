<?php
if(isset($_GET['editado']) && !empty($_GET['editado'])){
    $editado = $_GET['editado'];
    if($editado == 1){
        echo '<div class="acerto alerta">Usuário editado com sucesso</div>';
    }
}

if(isset($_GET['excluido']) && !empty($_GET['excluido'])){
    $excluido = $_GET['excluido'];
    if($excluido == 1){
        echo '<div class="acerto alerta">Usuário excluído com sucesso</div>';
    }
}

if(isset($_GET['alterado']) && !empty($_GET['alterado'])){
    $alterado = $_GET['alterado'];
    if($alterado == 1){
        echo '<div class="acerto alerta">Foto alterada com sucesso</div>';
    }
}

if(isset($_GET['alteraSenha']) && !empty($_GET['alteraSenha'])){
    $alteraSenha = $_GET['alteraSenha'];
    if($alteraSenha == 1){
        echo '<div class="acerto alerta">Senha alterada com sucesso</div>'; 
    }
}
?>