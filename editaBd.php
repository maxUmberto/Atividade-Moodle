<?php
//Inicializando a sessão
session_start();

function editaUsuario($campos,$id,$logado){
    //Incluindo código para conexão no banco de dados
    include 'config.php';
    
    //Transformando variáveis do Array em variáveis únicas
    $nome = addslashes($campos['nome']);
    $email = addslashes($campos['email']);
    $dia = addslashes($campos['dia']);
    $mes = addslashes($campos['mes']);
    $ano = addslashes($campos['ano']);
    $login = addslashes($campos['login']);
    
    //Caso o usuário esteja logado, a sessão pegará os novos
    //dados para serem exibidos na index
    if($logado == 1){
        //Atribuindo o valor das variáveis as sessões
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['login'] = $login;
        $_SESSION['data_aniversario'] = "$ano-$mes-$dia";
    }
    
    //Código sql para atualização das informações do usuário
    $sql = "UPDATE usuario SET nome = '$nome', email = '$email',"
        ."data_nascimento = '$ano-$mes-$dia', login = '$login'"
        ."WHERE id = '$id'";
    $sql = $pdo -> query($sql);
    
    header('Location: index.php?editado=1');
}
?>