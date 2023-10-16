<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "educaplay";

// Cria a conexão
$conexao = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>