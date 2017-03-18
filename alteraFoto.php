<html>
<head>
    <meta charset="utf-8">
    <title>Altera Foto</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
        <h1 class="titulo">Altere a sua foto</h1>
<?php
session_start();

//Conexão com o banco de dados
include 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    //variável id recebe o id enviado
    $id = $_GET['id'];
    
    //Faz a consulta para ver se o id existe
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $sql = $pdo -> query($sql);
    
    //confere se o banco de dados retornou algo
    //caso não tenha, ele redireciona para a index
    if($sql -> rowCount() < 1){
        header('Location: index.php');
    }
}else{
    //Caso não exista nenhum id ou este esteja em branco
    //o usuário será redirecionado para a index.php
    header('Location: index.php');
}

if(isset($_FILES['foto']) && !empty($_FILES['foto'])){
    //variável arquivo recebe o arquivo
    $arquivo = $_FILES['foto'];
    
    //Variável para confirmar se o formato da imagem
    //escolhida é valida
    $formato = 0;
    
    //verificando o formato da imagem
    if($arquivo['type'] == 'image/png'){
        //O nome da foto será a hora atual em milisegundos, mais um
        //número aleatório entre 0 e 99 e criptografada no padrão md5
        //, evitando assim que existam duas fotos com o mesmo nome
        $nome = md5(time().rand(0,99)).'.png';
        $formato = 1;//Informa que o formato da imagem é válido
    }elseif($arquivo['type'] == 'image/jpg' || $arquivo['type'] == 'image/jpeg'){
        $nome = md5(time().rand(0,99)).'.jpg';
        $formato = 1;
    }
    
    if($formato == 1){//Confere se o formato da imagem é válido e altera no banco
        //Altera o nome da imagem no banco de dados
        $sql = "UPDATE usuario SET nome_foto = '$nome' WHERE id = '$id'";
        $pdo -> query($sql);//executa o comando

        //envia para um das variáveis da sessão o novo nome da foto
        $_SESSION['nome_foto'] = $nome;

        //move a imagem da para a pasta de destino
        move_uploaded_file($arquivo['tmp_name'],'fotos/'.$nome);

        //Como tudo deu certo, redireciona o usuário para a index
        header('Location: index.php?alterado=1'); 
    }else{
        //Mensagem de erro caso o formato seja inválido
        echo 'Formato inválido. Só são aceitos os formatos JPG/JPEG/PNG';
    }    
}
?>
        <div class="formulario">
            <form method="post" enctype="multipart/form-data">
                Selecione a foto:<br>
                <input type="file" name="foto"><br><br>
    
                <input type="submit" name="enviar" value="Alterar Foto" class="submit">
            </form>
            <a href="index.php" class="voltar">Voltar</a><br><br>
       </div>
       <!-- fim da div formulario -->
    </div>
    <!-- fim da div alinha -->
</div>
<!-- fim da div container -->
</body>
</html>