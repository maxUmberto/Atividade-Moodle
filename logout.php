<?php
session_start();//Iniciando a sessão


session_destroy();//Destruindo a sessão
header('Location: index.php');//Redirecionando para a index
exit;
?>