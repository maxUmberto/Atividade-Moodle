<?php
$dsn = "mysql:dbname=moodle;host=localhost";
$dbuser = "root";
$dbpass = "";

try{
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Falhou a conexão: ". $e -> getMessage();
}
?>