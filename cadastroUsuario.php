<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
        <h1 class="titulo">Formulário de cadastro</h1>
        <h3 class="titulo">Preencha os dados para se cadastrar</h3>
<?php
//Incluido o código da validação
include 'validacao.php';
        
//Código para cadastrar no banco
include 'cadastraBd.php';

//Criando as variáveis para armazenar as informações
//enviadas no formulário
$nome = '';
$email = '';
$dia = 0;
$mes = 0;
$ano = 0;
$login = '';

//Verifica se o formulário foi enviado
if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar'])){
    $campos = array(
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'dia' => $_POST['dia'],
        'mes' => $_POST['mes'],
        'ano' => $_POST['ano'],
        'login' => $_POST['login'],
        'senha' => $_POST['senha'],
        'senha2' => $_POST['senha2'],        
    );
    
    /*
    Por algum motivo desconhecido, esse trecho de código comentado não funciona
    Por motivos de força maior, fui obrigado a utilizar um jeito feio e repetitivo
    Porém funciona, o que é mais importante
    function erro(array $campos){
        //Variáveis que serão exibidas caso haja algum erro no formulário
        $nome = $campos['nome'];
        $email = $campos['email'];
        $dia = $campos['dia'];
        $mes = $campos['mes'];
        $ano = $campos['ano'];
        $login = $campos['login'];
    }
    
    if(validacao($campos) == 1){
        erro($campos);
    }elseif(cadastraBD($campos) == 1){
        erro($campos);
    }*/
    
    if(validacao($campos) == 1){
        //Variáveis que serão exibidas caso haja algum erro no formulário
        $nome = $campos['nome'];
        $email = $campos['email'];
        $dia = $campos['dia'];
        $mes = $campos['mes'];
        $ano = $campos['ano'];
        $login = $campos['login'];
    }elseif(cadastraBD($campos) == 1){
        //Variáveis que serão exibidas caso haja algum erro no formulário
        $nome = $campos['nome'];
        $email = $campos['email'];
        $dia = $campos['dia'];
        $mes = $campos['mes'];
        $ano = $campos['ano'];
        $login = $campos['login'];
    }
}
?>
        <div class="formulario">
            <form method="post">
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
                    <input type="text" name="login" value="<?php echo $login; ?>">
                </div><br><br> 
            
                <div class="input">    
                    Senha:<br>
                    <input type="password" name="senha">
                </div>
               
                <div class="input">
                    Confirme sua senha:<br>
                    <input type="password" name="senha2">
                </div><br><br>

                <input type="submit" name="cadastrar" value="Cadastrar" class="submit">
            </form>
            <a href="login.php" class="voltar">Voltar</a><br><br>
        </div>
        <!-- Fim da div formulario -->
    </div>
    <!-- Fim da div cadastro -->
</div>
<!-- Fim da div container -->
</body>
</html>