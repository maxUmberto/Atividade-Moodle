<html>
<head>
    <meta charset="utf-8">
    <title>Exclui Usuário</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
        <h1 class="titulo">Excluir um usuário</h1>
        <h3 class="titulo">Verifique as informações antes de exluir o usuário</h3>
        <h5 class="titulo">ESSA OPERAÇÃO NÃO PODE SER DESFEITA</h5>
<?php
//conexao com o banco de dados
include 'config.php';
    
if(isset($_GET['id']) && !empty($_GET['id'])){
    //variável id recebe o id enviado
    $id = $_GET['id'];
    
    //busca no bd para uso logo abaixo no código
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $sql = $pdo -> query($sql);
    
    //confere se o banci retornou algum resultado
    if($sql -> rowCount() > 0){
        $dado = $sql -> fetch();
    }else{
        //caso não tenha nenhum resultado redireciona para a index
        header('Location: index.php');
    }

?>
        <div class="formulario">
            <form method="post">
                Nome:<br>
                <input type="text" name="nome" value="<?php echo $dado['nome']; ?>"><br>
            
                Data Aniversário:<br> 
                Dia:
                <select name="dia" class="selecao">
                    <?php
                        for($i = 1; $i <= 31; $i++){//For que vai de 0 a 31 representando os dias
                            if($i == date('d',strtotime($dado['data_nascimento']))){//compara o I com o valor de $dia
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
                            if($i == date('m',strtotime($dado['data_nascimento']))){//compara o I com o valor de $mes
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
                            if($i == date('Y',strtotime($dado['data_nascimento']))){//compara o I com o valor de $ano
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
                    <input type="email" name="email" value="<?php echo $dado['email']; ?>">
                </div> 
            
                <div class="input">    
                    Login:<br>
                    <input type="text" name="login" value="<?php echo $dado['login']; ?>">
                </div><br><br> 
                
                <a href="excluibd.php?id=<?php echo $id?>" class="voltar excluir">Excluir</a><br><br>
                <a href="index.php" class="voltar">Voltar</a>
            </form>
        </div>
        <!-- Fim da div formulario -->
    </div>
    <!-- Fim da div cadastro -->
</div>
<!-- Fim da div container -->
</body>
<?php
}else{
    //caso não exista um id redireciona para a index
    header('Location: index.php');
}
?>