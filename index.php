<html>
<head>
    <meta charset="utf-8">
    <title>Página Inicial</title>
    
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="alinha">
<?php
//Conexão com o banco de dados
include 'config.php';

//Mensagens de confirmação
include 'alertas.php';

//iniciando a sessão
session_start();

//Confere se a Sessão ID existe e se não está vazia
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
    //atribuindo os valores das SESSIONS as suas variáveis
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $aniversario = $_SESSION['data_aniversario'];
    $foto = $_SESSION['nome_foto'];
}else{
    header('Location: login.php');
}
?>
        <div class="perfil">
            <div class="img-perfil">
                <img src="fotos/<?php echo $foto; ?>" alt="<?php echo $nome; ?>" width="300px" height="250px;"><br>
                <a href="alteraFoto.php?id=<?php echo $id; ?>">Trocar foto</a>
            </div>
            <p>
                <?php echo $nome; ?>
            </p>
        </div>
        <!-- fim div perfil -->

        <div class="conteudo">
            <div class="informacoes">
                <h4>Informações:</h4>
                <p>Email: <i><?php echo $email; ?></i></p>
                <p>Aniversário:
                    <?php echo date('d/m/Y',strtotime($aniversario)); ?>
                </p>

                <div class="acoes_perfil">
                    <ul>
                        <li><a href="<?php echo "edita.php?id=$id&logado=1" ?>">Editar Perfil</a></li>
                        <li><a href="<?php echo "alteraSenha.php?id=$id" ?>">Editar Senha</a></li>
                        <li><a href="logout.php">Sair</a></li>
                    </ul>
                </div>
                <!-- fim div acoes_perfil -->
            </div>
            <!-- Fim da div informações -->

            <div class="lista">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Aniversário</th>
                        <th>Login</th>
                        <!--<th>Ações</th>-->
                    </tr>
                    <?php
                        $sql = "SELECT * FROM usuario";//seleciona todos os usuários cadastrados
                        $sql = $pdo -> query($sql);//executa a query
                        if($sql -> rowCount() > 1){//confere se o banco de dados retornou algo
                            foreach($sql -> fetchAll() as $dado){//percorre o array retornado pelo BD
                                //Confere se o ID do banco é diferente do ID que está com a sessão ativa
                                //Desse jeito se evita que quem esteja logado possa fazer alterações através
                                //das ações da lista ou se excluir
                                if($id != $dado['id']){
                                    echo '<tr>';
                                    echo '<td>'.$dado['nome'].'</td>';
                                    echo '<td>'.$dado['email'].'</td>';
                                    echo '<td>'.date('d/m/Y',strtotime($dado['data_nascimento'])).'</td>';
                                    echo '<td>'.$dado['login'].'</td>';
                                    //echo '<td><a href="edita.php?id='.$dado['id'].'">Editar</a> '
                                    //    .'<a href="exclui.php?id='.$dado['id'].'">Excluir</a></td>';
                                    echo '</tr>';
                                }
                            }
                        }else{
                            echo '<tr><td colspan="5">Não foi encontrado ninguém cadastrado</td></tr>';
                        }
                    ?>
                </table>
            </div>
            <!-- Fim da div lista -->
        </div>
        <!-- Fim da div conteudo -->
    </div>
    <!-- fim da div alinha -->
    <div class="espaco"></div>
</div>
<!-- fim div container -->
</body>

</html>

<?php    
?>