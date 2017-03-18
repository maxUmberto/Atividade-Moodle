<?php

//Função para cadastrar no banco
function cadastraBD($campos){
    //Incluindo código para conexão no banco de dados
    include 'config.php';
    
    //Transformando variáveis do Array em variáveis únicas
    $nome = addslashes($campos['nome']);
    $email = addslashes($campos['email']);
    $dia = addslashes($campos['dia']);
    $mes = addslashes($campos['mes']);
    $ano = addslashes($campos['ano']);
    $login = addslashes($campos['login']);
    $senha = md5(addslashes($campos['senha']));
    
    //buscando e selecionando qualquer cadastro que tenha o login igual
    $sql = "SELECT * FROM usuario WHERE login = '$login'";
    $sql = $pdo -> query($sql);//Executando a query
    
    if($sql -> rowCount() > 0){//Verifica se a busca achou algum login identico
        echo 'Login já existe';//Mensagem de erro;
        return 1;
    }
    else{
        //SQL para cadastrar o novo usuário
        $sql = "INSERT INTO usuario (nome, email, data_nascimento, login, senha, nome_foto)"
            ."VALUES ('$nome','$email','$ano-$mes-$dia','$login','$senha','padrao.png')";
        $pdo -> query($sql);//execução da query
        //Redireciona o usuário para a página login levando cadastrado com valor 1
        //para exibir uma mensagem de confirmação de cadastro
        header('Location: login?cadastrado=1');
    }
}
?>