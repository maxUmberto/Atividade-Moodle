<html>
<head>
    <meta charset="utf-8">
    <title>Altera Senha</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
        <h1 class="titulo">Alterar a Senha</h1>
<?php
//conexao com o banco de dados
include 'config.php';
    
if(isset($_GET['id']) && !empty($_GET['id'])){
    //variável id recebe o id enviado
    $id = $_GET['id'];
    
    //COnfere se já enviaram o formulário pra atualizar a senha
    if(isset($_POST['atualizar'])){
        //variáveis recebem os valores informados pelo usuário
        $senhaAtual = $_POST['senha'];
        $novaSenha = $_POST['novaSenha'];
        $novaSenha2 = $_POST['novaSenha2'];
        
        //inicialzando variável erro como vazia
        $erro = '';
        
        //busca sql pra fazer consultas logo abaixo no código
        $sql = "SELECT * FROM usuario WHERE id = '$id'";
        $sql = $pdo -> query($sql);
        
        //confere se o banco retornou algum resultado
        if($sql -> rowCount() > 0){
            $dado = $sql -> fetch();
        }else{
            //Caso o banco não tenha retornado nenhum resultado
            //o usuário é encaminhado para a index
            header('Location: index.php');
        }
        
        if(empty($senhaAtual)){//Confere se o usuário informou a senha atual
            $erro = 'Senha atual vazia<br>';
        }elseif(strlen($senhaAtual) < 8){//Confere se a senha tem o tamanho mínimo
            $erro = 'Senha muito curta<br>';
        }elseif(md5(addslashes($senhaAtual)) != $dado['senha']){//confere se a senha atual informada
            $erro .= 'Senha atual errada<br>';                  // é a mesma salva no banco
        }
        
        if(empty($novaSenha)){//Confere se o usuário digitou a nova senha
            $erro .= 'Informe a nova senha<br>';
        }elseif(strlen($novaSenha) < 8){//Confere se a senha tem o tamanho mínimo
            $erro .= 'Nova senha muito curta<br>';
        }
        
        if(empty($novaSenha2)){//confere se o usuário confirmou a senha
            $erro .= 'Confirme sua senha<br>';
        }elseif(strlen($novaSenha2) < 8){//confere se a senha tem o tamanho mínimo
            $erro .= 'Confirmação de senha muito curta<br>';
        }
        
        if($novaSenha != $novaSenha2){//confere se a senha foi confirmada corretamente
            $erro .= 'Senhas são diferentes';
        }
        
        if($erro != ''){
            echo '<div class="erro">'.$erro.'</div>';//Mostra o erros encontrados
        }else{//caso n]ao seja encontrado nenhum erro, atualiza a senha
            $novaSenha = md5(addslashes($_POST['novaSenha']));//criptogrando a nova senha
            
            //atualizando a senha no banco de dados
            $sql = "UPDATE usuario SET senha = '$novaSenha' WHERE id = '$id'";
            $pdo -> query($sql);
            
            //redirecionado o usuário para a index
            header('Location: index.php?alteraSenha=1');
        }
    }
}else{
    //caso o id não exista, redireciona o usuário para a index
    header('Location: index.php');
}
?>
        <div class="formulario">
            <form method="post">
                Senha atual:<br>
                <input type="password" name="senha"><br><br>
    
                Nova senha:<br>
                <input type="password" name="novaSenha"><br><br>
    
                Confirme a nova senha:<br>
                <input type="password" name="novaSenha2"><br><br>
    
                <input type="submit" name="atualizar" value="Atualizar" class="submit">
            </form>
            <a href="index.php" class="voltar">Voltar</a><br><br>
        </div>
        <!-- Fim da div formulário -->
    </div>
    <!-- fim da div alinha -->
</div>
<!-- fim da div container -->
<br>

