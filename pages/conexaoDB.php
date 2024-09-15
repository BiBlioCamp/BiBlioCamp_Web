<?php

try{
    global $pdo;
    //conexão PDO  // IP, nomeBD, usuario, senha
    $db = "mysql:host=143.106.241.3;dbname=cl202235;charset=utf8";

    $user = 'cl202235';
    $password = 'cl*17062007';

    $pdo = new PDO($db,$user,$password);

    //ativar o depurador de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    $output = 'Impossível conectar BD : ' . $e . '<br>';
    echo $output;
}