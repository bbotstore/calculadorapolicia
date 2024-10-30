<?php
 
    require 'php/conexao.php';
    session_start();
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $sql = "INSERT INTO logs (id_usuario, dt, dados) VALUES (:id_usuario, :dt, :dados)";
    $cmd = $con->prepare($sql);
    $cmd->bindValue(':id_usuario',$_SESSION['dados_usuario']['id_usuario']);
    $cmd->bindValue(':dt',date('Y-m-d H:i:s'));
    $cmd->bindValue(':dados','Fez Logoff - '.$ip);
    $cmd->execute();
    session_unset();
    session_destroy();
    header("location: login.php");

?>