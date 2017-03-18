<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>
<?php
//iniciando a sessão
session_start();

//conexão com o banco de dados
include 'config.php';

//inicializando a variável como nula
$login = '';

//caso o usuário chegue até aqui depois de fazer o cadastro
//é exibida a mensagem dizendo que ele foi cadastrado com 
//sucesso
if(isset($_GET['cadastrado']) && $_GET['cadastrado'] == 1){
    $acerto = "<div class='acerto'>Cadastrado com sucesso</div>";
}

if(isset($_POST['entrar'])){//confere se o usuário está tentando se logar
    //armazena os dados informados pelo usuário
    $login = addslashes($_POST['login']);
    $senha = md5(addslashes($_POST['senha']));
    
    //procura no banco pelo usuário
    $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
    $sql = $pdo -> query($sql);
    
    //confere se o bd retornou algum resultado
    if($sql -> rowCount() > 0){
        $dado = $sql -> fetch();
        
        //atribui os resultados do banco a variáveis de sessão
        $_SESSION['id'] = $dado['id'];
        $_SESSION['nome'] = $dado['nome'];
        $_SESSION['email'] = $dado['email'];
        $_SESSION['data_aniversario'] = $dado['data_nascimento'];
        $_SESSION['nome_foto'] = $dado['nome_foto'];
        
        //redireciona o usuário para a index
        header('Location: index.php');
    }else{
        //caso o usuário não seja encontrado, exibe-se essa mensagem
        //alertando que algum dado está incorreto
        $erro = '<div class="erro">Login ou senha incorretos</div>';
    }
}
?>

<body>
   <div class="container">
    <div class="alinha">
        <h1 class="titulo">Bem vindo!</h1>
        <h3 class="titulo">Faça seu login</h3>
        <?php
            if(isset($erro)){
                echo $erro;
            }
            if(isset($acerto)){
                echo $acerto;
            }
        ?>
            <div class="formulario">
                <form method="post">
                    Login
                    <br>
                    <input type="text" name="login" value="<?php echo $login; ?>">
                    <br>
                    <br> 
                    
                    Senha
                    <br>
                    <input type="password" name="senha">
                    <br>
                    <br>

                    <input type="submit" value="Entrar" name="entrar" class="submit">
                </form>

                <p>Ainda não tem cadastro? <a href="cadastroUsuario.php">Cadastre-se agora</a></p>
            </div>
            <!-- Fim da div formulario -->
    </div>
    <!-- Fim da div login -->
    </div>
    <!-- Fim da div container -->
</body>
</html>