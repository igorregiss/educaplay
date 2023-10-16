<?php
$conexao = mysqli_connect('localhost', 'root', '');

if(!$conexao){
    die("Erro ao conectar a base!");/**die é morte, interrope a conexão */
}
else{
    mysqli_select_db($conexao, 'educaplay');
}
?>