<html>
<head>
    <meta charset="utf-8">
    <title>Editar Dados</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
        <h1 class="titulo">Editar Usuário</h1>
        <h3 class="titulo">Insira as novas informações do usuário</h3>
<?php
//conexão com o banco de dados
include 'config.php';

//validação do formulário
include 'validacao.php';

//Alteração dos dados no banco de dados
include 'editaBd.php';

//Variáveis
$id = 0;
$logado = 0;

//Confere se quem está tentando editar está logado ou não
if(isset($_GET['logado']) && !empty($_GET['logado'])){
    $logado = $_GET['logado'];
}

//Confere se o id do usuário existe e se não está vazio
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $sql = $pdo -> query($sql);
    
    if($sql -> rowCount() > 0){
        $dado = $sql -> fetch();
        $nome = $dado['nome'];
        $email = $dado['email'];
        $dia = date('d',strtotime($dado['data_nascimento']));
        $mes = date('m',strtotime($dado['data_nascimento']));
        $ano = date('Y',strtotime($dado['data_nascimento']));
        $login = $dado['login'];
    }
}

if(isset($_POST['editar'])){
    $campos = array(
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'dia' => $_POST['dia'],
        'mes' => $_POST['mes'],
        'ano' => $_POST['ano'],
        'login' => $_POST['login'],        
    );
    
    if(validacao($campos) == 1){
        //Variáveis que serão exibidas caso haja algum erro no formulário
        $nome = $campos['nome'];
        $email = $campos['email'];
        $dia = $campos['dia'];
        $mes = $campos['mes'];
        $ano = $campos['ano'];
        $login = $campos['login'];
    }else{
        editaUsuario($campos,$id,$logado);
    }
}
?>
        <div class="formulario">
            <form method="post" enctype="multipart/form-data">
                Nome:<br>
                <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
    
                Data Aniversário:<br>
                Dia:
                <select name="dia" class="selecao">
                <?php
                    for($i = 1; $i <= 31; $i++){//For que vai de 0 a 31 representando os dias
                        if($i == $dia){//compara o I com o valor de $dia
                        //Seleciona o valor de I correspondente ao valor de $dia
                        echo '<option value='.$i.' selected>'.$i.'</option>';
                        }else{
                            echo '<option value='.$i.'>'.$i.'</option>';//Exibe os dias normalmente
                        }
                    }
                ?>
                </select>
    
                Mês:
                <select name="mes" class="selecao">
                <?php
                    for($i = 1; $i <= 12; $i++){//For que vai de 0 a 12 representando os meses
                        if($i == $mes){//compara o I com o valor de $mes
                        //Seleciona o valor de I correspondente ao valor de $mes
                        echo '<option value='.$i.' selected>'.$i.'</option>';
                        }else{
                            echo '<option value='.$i.'>'.$i.'</option>';//Exibe os meses normalmente
                        }
                    }
                ?>
                </select>
    
                Ano:
                <select name="ano" class="selecao">
                <?php
                    for($i = 2017; $i >= 1900; $i--){//For que vai de 0 a 12 representando os anos
                        if($i == $ano){//compara o I com o valor de $ano
                        //Seleciona o valor de I correspondente ao valor de $ano
                        echo '<option value='.$i.' selected>'.$i.'</option>';
                    }else{
                        echo '<option value='.$i.'>'.$i.'</option>';//Exibe os anos normalmente
                    }
                }
                ?>
                </select><br><br>
    
                <div class="input">
                    Email:<br>
                    <input type="email" name="email" value="<?php echo $email; ?>">
                </div>
    
                <div class="input">
                    Login:<br>
                    <input type="text" name="login" value="<?php echo $dado['login']; ?>">
                </div><br><br>
    
                <input type="submit" name="editar" value="Editar" class="submit">
            </form>
            <a href="index.php" class="voltar">Voltar</a><br><br>
        </div>
        <!-- fim da div formulário -->
    </div>
    <!-- fim da div edita -->
</div>
<!-- Fim da div container -->
